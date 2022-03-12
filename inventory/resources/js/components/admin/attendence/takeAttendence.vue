
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
                  <h3 class="card-title">Take Attendance</h3>
                  <div class="text-right">
                    <router-link
                      to="/categoryAdd"
                      class="btn btn-primary btn-sm"
                      >Add</router-link
                    >
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="form-group">
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="date" v-model="attendence_date" name="attendence_date" class="form-control " data-target="#reservationdate"/>
                    </div>
                    <div class="containError" v-if="errors && errors.attendence_date" >
                      {{ errors.attendence_date[0] }}
                    </div>
                  </div>

                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">SN</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Attendence</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(employee, x) in getEmployeeListFromStore"
                        :key="employee.id"
                       >
                        <td>{{ x + 1 }}</td>
                        <td>{{ employee.employee_name }}</td>
                        <td> <img v-bind:src="`/images/employee/${employee.employee_image}`" class="image" /></td>
                        <td>
                            <a @click.prevent="attendencePresent(employee.id,attendence_status='present')" class="btn btn-success btn" >P</a>
                            <a @click.prevent="attendenceAbsent(employee.id,attendence_status='absent')" class="btn btn-danger btn" >A</a>
                  
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
  data() {
    return {
      attendence_date:"",

      errors: {},
    };
  },

  mounted() {
    this.$store.dispatch("employeeListSaveInStore");
  },

  computed: {
    getEmployeeListFromStore() {
      return this.$store.getters.employeeListFromStore;
    },
  },

  methods: {
    
    attendencePresent(employee_id, attendence_status) {
     
     let form = new FormData();
      form.append("employee_id",employee_id);
      form.append("attendence_status",attendence_status);
      form.append("attendence_date",this.attendence_date);

      axios.post("/attendenceStore", form).then((response) => {
          if(response.data.status == 'Exist')
          {
              Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Attendance already taken!",
            });
          }
          else if(response.data.status == 'NotExist')
          {
            Toast.fire({
            icon: "success",
            title: "Attendence save successfully",
            });
          } else {

           }
          
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
   
   },
    attendenceAbsent(employee_id, attendence_status) {
      let form = new FormData();
      form.append("employee_id",employee_id);
      form.append("attendence_status",attendence_status);
      form.append("attendence_date",this.attendence_date);

      axios.post("/attendenceStore", form).then((response) => {
          if(response.data.status == 'Exist')
          {
              Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Attendance  already taken!",
            });
          }
          else if(response.data.status == 'NotExist')
          {
            Toast.fire({
            icon: "success",
            title: "Attendance  save successfully",
            });
          } else {

           }
          
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
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