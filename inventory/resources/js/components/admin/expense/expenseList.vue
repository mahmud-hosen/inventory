
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
                  <h3 class="card-title">Expense List</h3>
                  <div class="text-right">
                    <router-link to="/expenseAdd" class="btn btn-primary btn-sm"
                      >Add</router-link
                    >
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">SN</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(expenseList, x) in getExpenseListFromStore"
                        :key="expenseList.id"
                      >
                        <td>{{ x + 1 }}</td>
                        <td>{{ expenseList.expense_amount }}</td>
                        <td>{{ expenseList.expense_description }}</td>
                        <td>{{ expenseList.expense_date }}</td>
                        <td>
                          <div class="">
                            <router-link
                              :to="`/expenseEdit/${expenseList.id}`"
                              class="btn btn-info btn-xs"
                              ><i class="fas fa-edit"></i
                            ></router-link>
                            <a
                              @click.prevent="expenseDelete(expenseList.id)"
                              class="btn btn-info btn-xs"
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
    this.$store.dispatch("ExpenseListSaveInStore");
  },

  //  Step: 10
  computed: {
    getExpenseListFromStore() {
      return this.$store.getters.expenseListFromStore;
    },
  },

  data() {
    return {
      cash_amount: "",
      cash_date: "",
      totalCash: "",
      errors: {},
    };
  },

  methods: {
    expenseDelete(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You want to delete this expense!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios.get("/expenseDelete/" + id).then((response) => {
            this.$store.dispatch("ExpenseListSaveInStore");
            Swal.fire("Deleted!", "Expense deleted successfully", "success");
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