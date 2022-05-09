<template>
  <div>
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-md-6 mt-2">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title mt-1">Cash Amount Add</h3>
              </div>
              <form role="form" @submit.prevent="cashSave" enctype="multipart/form-data" >
                <div class="card-body">
                  <div class="form-group">
                    <label for="inputName">Amount</label>
                    <input type="text" v-model="cash_amount" id="cash_amount" name="cash_amount" class="form-control" />
                    <div class="containError" v-if="errors && errors.cash_amount" >
                      {{ errors.cash_amount[0] }}
                    </div>
                  </div>
                  <div class="form-group">
                        <label for="inputName">Cash Date </label>
                        <input  type="date"  v-model="cash_date"  id="cash_date"  name="cash_date"  class="form-control"  />
                        <div class="containError"  v-if="errors && errors.cash_date" >
                          {{ errors.cash_date[0] }}
                        </div>
                      </div>
                </div>

                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-primary btn-sm">
                    Submit
                  </button>
                  <button type="submit" @click="goBack" class="btn btn-danger btn-sm px-3" >
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
  data() {
    return {
      cash_amount: "",
      cash_date: "",
      errors: {},
    };
  },

  methods: {
   
    cashSave() {
      let form = new FormData();
      form.append("cash_amount", this.cash_amount);
      form.append("cash_date", this.cash_date);

      axios.post("/cashStore", form).then((response) => {
          this.$router.push("/cashList");
          Toast.fire({
            icon: "success",
            title: "Cash added successfully",
          });
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },

    goBack() {
      this.$router.push("/categoryList");
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