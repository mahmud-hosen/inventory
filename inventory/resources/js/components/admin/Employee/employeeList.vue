<template>
  <div>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <section class="content">
        <!--/. container-fluid -->
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Employee List</h3>
                  <div class="text-right">
                    <router-link
                      to="/employeeAdd"
                      class="btn btn-primary btn-sm"
                      >Add
                    </router-link>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th> Name</th>
                        <th> Phone</th>
                        <th> Address</th>
                        <th> NID</th>
                        <th> Experience</th>
                        <th> Salary</th>
                        <th>Image</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(employee, x) in getEmployeeListFromStore"
                        :key="employee.id"
                      >
                        <td>{{ x + 1 }}</td>
                        <td>{{ employee.employee_name }}</td>
                        <td>{{ employee.employee_phone }}</td>
                        <td>{{ employee.employee_address }}</td>
                        <td>{{ employee.employee_nid }}</td>
                        <td>{{ employee.employee_experience }}</td>
                        <td>{{ employee.employee_salary }}</td>

                        <td v-if="employee.employee_image != null">
                          <img
                            v-bind:src="`/images/employee/${employee.employee_image}`"
                            class="image"
                          />
                        </td>
                        <td v-if="employee.employee_image == null">
                          <img
                            v-bind:src="`/images/user/user.png`"
                            class="image"
                          />
                        </td>
                        <td class="text-right py-0 align-middle">
                          <div class="btn-group btn-group-sm">
                            <router-link
                              :to="`/employeeEdit/${employee.id}`"
                              class="btn btn-info"
                              ><i class="fas fa-edit"></i
                            ></router-link>
                            <a
                              @click.prevent="employeeDelete(employee.id)"
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

  //  Step: 4
  mounted() {
    this.$store.dispatch("employeeListSaveInStore");
  },

  computed: {
    getEmployeeListFromStore() {
      return this.$store.getters.employeeListFromStore;
    },
  },

  methods: {
    employeeDelete(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You want to delete this customer!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios.get("/employeeDelete/" + id).then((response) => {
            this.$store.dispatch("employeeListSaveInStore");
            Swal.fire("Deleted!", "Employee deleted successfully", "success");
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