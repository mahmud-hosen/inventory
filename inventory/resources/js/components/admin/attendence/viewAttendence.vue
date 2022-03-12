
<template>
  <div>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <section class="content">
        <!--/. container-fluid -->
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-md-7 mt-3">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">View Attendance</h3>
                  <div class="text-right">
                    <router-link
                      to="/takeAttendence"
                      class="btn btn-primary btn-sm"
                      >Add</router-link
                    >
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="input-group input-group-sm mb-1">
                      <input  v-model="serachValue" name="serachValue" @keyup="serachAttendence"  class="form-control form-control" type="search" placeholder="Search by Employee ID or Date(YYYY-MM-DD)" aria-label="Search"> 
                    </div>
          
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">SN</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>

                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(employee, x) in employeeAttendenceList"
                        :key="employee.id"
                       >
                        <td>{{ x + 1 }}</td>
                        <td>{{ employee.employee_name }}</td>
                        <td> <img v-bind:src="`/images/employee/${employee.employee_image}`" class="image" /></td>                       
                        <td>
                          <span v-if="employee.attendence_status == 'present'" class="badge badge-success">{{employee.attendence_status}}</span>
                          <span v-if="employee.attendence_status == 'absent'" class="badge badge-warning">{{employee.attendence_status}}</span>
                        </td>
                        <td>
                          <div class="">
                            <router-link :to="`/editAttendence/${employee.id}`" class="btn btn-info btn-xs" ><i class="fas fa-edit"></i ></router-link>
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
    axios.get("/todayAttendenceList/").then((response) => {
        this.employeeAttendenceList = response.data.todayAttendenceList;
        }).catch((error) => {
          this.errors = error.response.data.errors;
        });
  },

  data() {
    return {
      employeeAttendenceList:[],
      serachValue:"",

      errors: {},
    };
  },


  methods: {
    serachAttendence() {
      axios.get("/getAttendenceBySearch/" + this.serachValue).then((response) => {
          this.employeeAttendenceList = response.data.attendenceListBySearch;
          console.log(this.salaryList);
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