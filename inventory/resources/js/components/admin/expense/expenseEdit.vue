<template>
  <div>
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-md-6 mt-2">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title mt-1">Expense Edit</h3>
              </div>
              <form role="form" @submit.prevent="expenseEdit" enctype="multipart/form-data" >
                <div class="card-body">
                 
                  <div class="form-group">
                    <label for="inputName">Expense Amount</label>
                    <input type="text" v-model="expense_amount" id="expense_amount" name="expense_amount" class="form-control" />
                    <div class="containError" v-if="errors && errors.expense_amount" >
                      {{ errors.expense_amount[0] }}
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputDescription">Expenses Description</label>
                    <textarea  id="expense_description"  v-model="expense_description"  name="expense_description"  class="form-control"  rows="4"  ></textarea>
                    <div class="containError" v-if="errors && errors.expense_description" >
                      {{ errors.expense_description[0] }}
                    </div>
                  </div>
                 

                  <div class="form-group">
                        <label for="inputName">Expenses Date </label>
                        <input  type="date"  v-model="expense_date"  id="expense_date"  name="expense_date"  class="form-control"  />
                        <div class="containError"  v-if="errors && errors.expense_date" >
                          {{ errors.expense_date[0] }}
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
   created() {
    axios.get("/expenseById/" + this.$route.params.expenseId)
      .then((response) => {
        this.expense_amount = response.data.expenseById.expense_amount;
        this.expense_description = response.data.expenseById.expense_description;
        this.expense_date = response.data.expenseById.expense_date;

      });
  },
  data() {
    return {
      expense_amount: "",
      expense_description:"",
      expense_date: "",
      errors: {},
    };
  },

  methods: {
   
    expenseEdit() {
      let form = new FormData();
      form.append("expense_amount", this.expense_amount);
      form.append("expense_description", this.expense_description);
      form.append("expense_date", this.expense_date);

      axios.post(`/expenseUpdate/${this.$route.params.expenseId}`, form).then((response) => {
          this.$router.push("/expenseList");
          Toast.fire({
            icon: "success",
            title: "Expense Update successfully",
          });
          
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },

    goBack() {
      this.$router.push("/expenseList");
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