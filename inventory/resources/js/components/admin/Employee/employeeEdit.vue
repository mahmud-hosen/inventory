

<template>
  <div>
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-md-8 mt-2">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title mt-1">Employee Edit</h3>
              </div>
              <form
                role="form"
                @submit.prevent="employeeUpdate"
                enctype="multipart/form-data"
              >
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputName">Employee Name </label>
                         <input type="text"  v-model="employee_name" id="employee_name" 
                           name="employee_name" class="form-control"/>
                        <div class="containError" v-if="errors && errors.employee_name" >
                          {{ errors.employee_name[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputName">Employee Phone</label>
                        <input  type="text" v-model="employee_phone" id="employee_phone"
                          name="employee_phone" class="form-control"/>
                        <div  class="containError" v-if="errors && errors.employee_phone" >
                          {{ errors.employee_phone[0] }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputName">Employee Address</label>
                        <input
                          type="text"
                          v-model="employee_address"
                          id="employee_address"
                          name="employee_address"
                          class="form-control"
                        />
                        <div
                          class="containError"
                          v-if="errors && errors.employee_address"
                        >
                          {{ errors.employee_address[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputName">Employee NID</label>
                        <input
                          type="text"
                          v-model="employee_nid"
                          id="employee_nid"
                          name="employee_nid"
                          class="form-control"
                        />
                        <div
                          class="containError"
                          v-if="errors && errors.employee_nid"
                        >
                          {{ errors.employee_nid[0] }}
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Employee Experience</label>
                        <select type="text" v-model="employee_experience" class="form-control" id="employee_experience" name="employee_experience" >
                          <option >One Year</option>
                          <option >Two Year</option>
                          <option >Three Year</option>
                          <option >Four Year</option>
                          <option >Five Year</option>
                        </select>
                       <div class="containError" v-if="errors && errors.employee_experience">
                                {{ errors.employee_experience[0] }}
                       </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputName">Employee Salary</label>
                        <input
                          type="text"
                          v-model="employee_salary"
                          id="employee_salary"
                          name="employee_salary"
                          class="form-control"
                        />
                        <div
                          class="containError"
                          v-if="errors && errors.employee_salary"
                        >
                          {{ errors.employee_salary[0] }}
                        </div>
                      </div>
                    </div>
                  </div>
                  

                  <div class="form-group">
                    <label for="inputProjectLeader">Employee Image</label>
                    <input
                      type="file"
                      id="employee_image"
                      name="employee_image"
                      @change="getImg"
                      class="form-control"
                    />
                    <div
                      class="containError"
                      v-if="errors && errors.employee_image"
                    >
                      {{ errors.employee_image[0] }}
                    </div>
                  </div>
                </div>
                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-primary btn-sm">
                    Submit
                  </button>
                  <button
                    type="submit"
                    @click="goBack"
                    class="btn btn-danger btn-sm px-3"
                  >
                    Back
                  </button>
                </div>
              </form>

              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
  </div>
</template>

<script>
export default {
   created() {
    axios.get("/employeeById/" + this.$route.params.employeeId).then((response) => {
        this.employee_name = response.data.employeeyById.employee_name;
        this.employee_phone = response.data.employeeyById.employee_phone;
        
        this.employee_address = response.data.employeeyById.employee_address;
        this.employee_nid = response.data.employeeyById.employee_nid;
        
        this.employee_experience = response.data.employeeyById.employee_experience;
        this.employee_salary = response.data.employeeyById.employee_salary;

        
      });
  },

  data() {
    return {
      employee_name: "",
      employee_phone: "",
      employee_address: "",
      employee_nid: "",
      employee_experience:"",
      employee_salary: "",
      employee_image: "",
      errors: {},
    };
  },

  methods: {
    getImg(e) {
      this.employee_image = e.target.files[0];
      if (this.employee_image.size > 2097152) {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "File is larger than 2MB!",
        });
      } else if (!e.target.files[0].name.match(/.(jpg|jpeg|png|gif)$/i)) {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Image extension is not support. Allow Extension is jpeg, jpg, png and gif",
        });
      } else {
      }
    },

    employeeUpdate() {
      let form = new FormData();
      form.append("employee_name", this.employee_name);
      form.append("employee_phone", this.employee_phone);
      form.append("employee_address", this.employee_address);
      form.append("employee_nid", this.employee_nid);
      form.append("employee_experience", this.employee_experience);
      form.append("employee_salary", this.employee_salary);
      form.append("employee_image", this.employee_image);

        axios.post(`/employeeUpdate/${this.$route.params.employeeId}`, form).then((response) => {
          this.$router.push("/employeeList");
          Toast.fire({
            icon: "success",
            title: "Employee Update successfully",
          });
          
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
      
      
    },

    goBack() {
      this.$router.push("/employeeList");
      // this.$router.push("/category");
    },
  },
};
</script>

<style>
.containError {
  color: red;
}
</style>