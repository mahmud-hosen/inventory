
<template>
  <div>
    <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
      <section class="content">
        <!--/. container-fluid -->
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-md-10 mt-3">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Order List</h3> 
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Customer Name</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Payment Status</th>
                        <th>Payment Method</th>
                        <th>Order Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(orderList, x) in getOrderListFromStore"
                        :key="orderList.id"
                      >
                        <td>{{ x + 1 }}</td>
                        <td>{{ orderList.customer_name }}</td>
                        <td>{{ orderList.total }}</td>
                        <td>{{ orderList.order_date }}</td>
                        <td>{{ orderList.payment_status }}</td>
                        <td>{{ orderList.payment_method }}</td>
                        <td>
                          <span v-if="orderList.order_status == 'Approved'" class="badge badge-success">{{orderList.order_status}}</span>
                          <span v-if="orderList.order_status == 'Pending'" class="badge badge-warning">{{orderList.order_status}}</span>
                        </td>
                        

                        <td class="text-right py-0 align-middle">
                          <div class="btn-group btn-group-sm">
                            <router-link
                              :to="`/orderDetails/${orderList.id}`"
                              class="btn btn-info"
                              >View</router-link>
                            
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
    this.$store.dispatch("OrderListSaveInStore");
  },

  //  Step: 10
  computed: {
    getOrderListFromStore() {
      return this.$store.getters.orderListFromStore;
    },
  },

  methods: {
    categoryDelete(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You want to delete this category!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios.get("/categoryDelete/" + id).then((response) => {
            this.$store.dispatch("OrderListSaveInStore");
            Swal.fire("Deleted!", "Category deleted successfully", "success");
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