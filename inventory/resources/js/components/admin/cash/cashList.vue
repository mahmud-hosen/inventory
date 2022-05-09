
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
                  <h3 class="card-title">Cash List</h3>
                  <div class="text-right">
                    <router-link
                      to="/cashAdd"
                      class="btn btn-primary btn-sm"
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
                        <th>Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(CashList, x) in getCashListFromStore"
                        :key="CashList.id"
                       >
                        <td>{{ x + 1 }}</td>
                        <td>{{ CashList.cash_amount }}</td>
                        <td>{{ CashList.cash_date }}</td>

                        <td>
                          <div class="">
                            <router-link :to="`/cashEdit/${CashList.id}`" class="btn btn-info btn-xs" ><i class="fas fa-edit"></i ></router-link>
                            <a @click.prevent="cashDelete(CashList.id)" class="btn btn-info btn-xs" ><i class="fas fa-trash"></i></a>
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
    this.$store.dispatch("CashListSaveInStore");
    this.$store.dispatch("TotalCashSaveInStore");

  },

  //  Step: 10
  computed: {
    getCashListFromStore() {
      return this.$store.getters.cashListFromStore;
    },
     getTotalCash() {
      return this.$store.getters.totalCashFromStore;
    },
  },

   data() {
    return {
      cash_amount: "",
      cash_date: "",
      totalCash:"",
      errors: {},
    };
  },

  methods: {
    cashDelete(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You want to delete this cash!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios.get("/cashDelete/" + id).then((response) => {
            this.$store.dispatch("CashListSaveInStore");
            Swal.fire("Deleted!", "Cash deleted successfully", "success");
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