
<template>
  <div>
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-md-6 mt-2">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title mt-1">Attendence Update</h3>
              </div>
              <form
                role="form"
                @submit.prevent="attendenceUpdate"
                enctype="multipart/form-data"
              >
                <div class="card-body">
                  <div class="form-group">
                    <label for="inputName">Employee Name</label>
                    <input
                      type="text"
                      v-model="employee_name"
                      id="employee_name"
                      name="employee_name"
                      class="form-control"
                      disabled
                    />
                    <div
                      class="containError"
                      v-if="errors && errors.employee_name"
                    >
                      {{ errors.employee_name[0] }}
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputName">Attendence Date</label>
                    <div
                      class="input-group date"
                      id="reservationdate"
                      data-target-input="nearest"
                    >
                      <input
                        type="date"
                        v-model="attendence_date"
                        name="attendence_date"
                        class="form-control"
                        data-target="#reservationdate"
                      />
                    </div>
                    <div
                      class="containError"
                      v-if="errors && errors.attendence_date"
                    >
                      {{ errors.attendence_date[0] }}
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputName">Attendence Status</label>
                    <div class="">
                      <input
                        type="radio"
                        id="absent"
                        value="absent"
                        v-model="attendence_status"
                      />
                      <label for="absent">Absent</label>

                      <input
                        type="radio"
                        id="present"
                        value="present"
                        v-model="attendence_status"
                        class="ml-2"
                      />
                      <label for="present">Present</label>

                      <div
                        class="containError"
                        v-if="errors && errors.attendence_status"
                      >
                        {{ errors.attendence_status[0] }}
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
  name: "Edit",

  created() {
    axios
      .get("/attendenceById/" + this.$route.params.attendenceId)
      .then((response) => {
        this.employee_name = response.data.attendenceById.employee_name;
        this.attendence_status = response.data.attendenceById.attendence_status;
        this.attendence_date = response.data.attendenceById.attendence_date;
      });
  },

  data() {
    return {
      employee_name: "",
      attendence_status: "",
      attendence_date: "",
      errors: {},
    };
  },

  methods: {
    attendenceUpdate() {
      let form = new FormData();
      form.append("attendence_status", this.attendence_status);
      form.append("attendence_date", this.attendence_date);

      axios.post(`/attendenceUpdate/${this.$route.params.attendenceId}`, form)
        .then((response) => {
          this.$router.push("/viewAttendence");
          Toast.fire({
            icon: "success",
            title: "Attendence Updated successfully",
          });
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },

    goBack() {
      this.$router.push("/viewAttendence");
      // this.$router.push("/category");
    },
  },
};
</script>

<style>
.containError {
  color: red;
}
.image {
  height: 60px;
  width: 100px;
}
</style>