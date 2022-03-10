<template>
  <div>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <section class="content">
        <!--/. container-fluid -->
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-md-8 mt-3">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Salary List</h3>
                  <div class="text-right">
                    <router-link to="/salaryAdd" class="btn btn-primary btn-sm"
                      >Add
                    </router-link>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="input-group input-group-sm mb-1">
                      <input  v-model="serachValue" name="serachValue" @keyup="serachSalary"  class="form-control form-control" type="search" placeholder="Search by Employee ID or Name or Month or Year or Date(YYYY-MM-DD)" aria-label="Search"> 
                    </div>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Salary</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(salaryList, x) in salaryList" :key="salaryList.id" >
                        <td>{{ x + 1 }}</td>
                        <td>{{ salaryList.employee_name }}</td>
                        <td> <img v-bind:src="`/images/employee/${salaryList.employee_image}`" class="image" /></td>

                        <td>{{ salaryList.employee_salary }}</td>
                        <td>{{ salaryList.employee_salary_month }}</td>
                        <td>{{ salaryList.employee_salary_year }}</td>                       

                        <td class="text-right py-0 align-middle">
                          <div class="btn-group btn-group-sm">
                            <router-link
                              :to="`/salaryEdit/${salaryList.id}`"
                              class="btn btn-info"
                              ><i class="fas fa-edit"></i
                            ></router-link>
                            <a
                              @click.prevent="salaryDelete(salaryList.id)"
                              class="btn btn-danger"
                              ><i class="fas fa-trash"></i
                            ></a>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/. container-fluid -->
      </section>
    </div>
    <!-- /.content-wrapper -->
  </div>
</template>

<script>
export default {
  name: "List",
    created() {
    axios.get("/salaryList/").then((response) => {
        this.salaryList = response.data.salaryList;
        }).catch((error) => {
          this.errors = error.response.data.errors;
          // console.log(this.errors);
        });
  },

    data() {
    return {
      salaryList: [],
      serachValue:"",

      errors: {},
    };
  },

  methods: {
     serachSalary() {

      axios.get("/getSalaryBySearch/" + this.serachValue).then((response) => {
          this.salaryList = response.data.SalaryListBySearch;
          console.log(this.salaryList);
        });
    },

    salaryDelete(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You want to delete this salary!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios.get("/salaryDelete/" + id).then((response) => {
            this.$store.dispatch("salaryListSaveInStore");
            Swal.fire("Deleted!", "Salary deleted successfully", "success");
          });
        }
      });
    },
  },
};
</script>

<style>
.image {
  height: 70px;
  width: 100px;
}
</style>