

<template>
  <div>
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-md-8 mt-2">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title mt-1">Salary Add</h3>
              </div>
              <form role="form"  @submit.prevent="EmployeeSalaryUpdate"  enctype="multipart/form-data"  >
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Select Employee Name</label>
                      <select type="text" v-model="employee_id" class="form-control" id="exampleInputEmail1" name="employee_id" >
                        <option :value="employee.id"  v-for="employee in getEmployeeListFromStore" :key="employee.id">
                          {{ employee.employee_name }}
                        </option>
                      </select>
                          <div class="containError" v-if="errors && errors.employee_id">
                                {{ errors.employee_id[0] }}
                          </div>
                      </div>
                    </div>
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputName">Salary Amount</label>
                        <input  type="text" v-model="employee_salary" id="employee_salary"
                          name="employee_salary" class="form-control"/>
                        <div  class="containError" v-if="errors && errors.employee_salary" >
                          {{ errors.employee_salary[0] }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Select Month</label>
                        <select type="text" v-model="employee_salary_month" class="form-control" id="employee_salary_month" name="employee_salary_month" >
                          <option value="">Please Select Month </option>
                          <option value="January">January</option>
                          <option value="February">February</option>
                          <option value="March">March</option>
                          <option value="April">April</option>
                          <option value="May">May</option>
                          <option value="June">June</option>
                          <option value="July">July</option>
                          <option value="August">August</option>
                          <option value="September">September</option>
                          <option value="October">October</option>
                          <option value="November">November</option>
                          <option value="December">December</option>
                        </select>
                       <div class="containError" v-if="errors && errors.employee_salary_month">
                                {{ errors.employee_salary_month[0] }}
                       </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Select Year</label>
                        <select type="text" v-model="employee_salary_year" class="form-control" id="employee_salary_year" name="employee_salary_year" >
                          <option >2022</option>
                          <option >2023</option>
                          <option >2024</option>
                          <option >2025</option>
                          <option >2026</option>
                        </select>
                       <div class="containError" v-if="errors && errors.employee_salary_year">
                                {{ errors.employee_salary_year[0] }}
                       </div>
                      </div>
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
  mounted() {
    this.$store.dispatch("employeeListSaveInStore");
  },
  computed: {
    getEmployeeListFromStore() {
      return this.$store.getters.employeeListFromStore;
    },
  },

   created() {
    axios.get("/salaryById/" + this.$route.params.salaryId)
      .then((response) => {
        this.employee_id = response.data.salaryById.employee_id;
        this.employee_salary =response.data.salaryById.employee_salary;
        this.employee_salary_month = response.data.salaryById.employee_salary_month;
        this.employee_salary_year = response.data.salaryById.employee_salary_year;

      });
  },


  data() {
    return {
      employee_id: "",
      employee_salary: "",
      employee_salary_month: "",
      employee_salary_year: "",
      errors: {},
    };
  },

  methods: {
  
    EmployeeSalaryUpdate() {
      let form = new FormData();
      form.append("employee_id", this.employee_id);
      form.append("employee_salary", this.employee_salary);
      form.append("employee_salary_month", this.employee_salary_month);
      form.append("employee_salary_year", this.employee_salary_year);
      

      axios.post(`/salaryUpdate/${this.$route.params.salaryId}`, form).then((response) => {

          this.$router.push("/employeeList");
          Toast.fire({
            icon: "success",
            title: "Employee salary update successfully",
          });
        }) .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },

    goBack() {
      this.$router.push("/salaryList");
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