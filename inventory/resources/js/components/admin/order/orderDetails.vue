
<template>
  <div>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Order Info -->
          <div class="row justify-content-center">
            <div class="col-md-6 mt-3">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Order Info</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <th>Order Number</th>
                        <td>{{ customarAndOrderDetails.id }}</td>
                      </tr>
                      <tr>
                        <th>Total Amount</th>
                        <td>{{ customarAndOrderDetails.total }}</td>
                      </tr>
                      <tr>
                        <th>Payment Status</th>
                        <td>{{ customarAndOrderDetails.payment_status }}</td>
                      </tr>
                      <tr>
                        <th>Payment Method</th>
                        <td>{{ customarAndOrderDetails.payment_method }}</td>
                      </tr>
                      <tr>
                        <th>Order Status</th>
                        <td>{{ customarAndOrderDetails.order_status }}</td>
                      </tr>
                      <tr>
                        <th>Order Date</th>
                        <td>{{ customarAndOrderDetails.order_date }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- Customer Info -->
          <div class="row justify-content-center">
            <div class="col-md-6 mt-3">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Customer Info</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <th>Customer Name</th>
                        <td>{{ customarAndOrderDetails.customer_name }}</td>
                      </tr>
                      <tr>
                        <th>Phone Number</th>
                        <td>{{ customarAndOrderDetails.customer_phone }}</td>
                      </tr>
                      <tr>
                        <th>Customer AC</th>
                        <td>
                          {{ customarAndOrderDetails.customer_account_number }}
                        </td>
                      </tr>
                      <tr>
                        <th>Address</th>
                        <td>{{ customarAndOrderDetails.customer_address }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- Product Info -->
          <div class="row justify-content-center">
            <div class="col-md-10 mt-3 text-center">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Product Info</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Unit Cost</th>
                        <th>Quantity</th>
                        <th>Sub Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(order, x) in order_details" :key="order.id">
                        <td>{{ x + 1 }}</td>
                        <td>{{ order.product_name }}</td>
                        <td>
                          <img
                            v-bind:src="`/images/product/${order.product_image}`"
                            class="image"
                          />
                        </td>
                        <td>{{ order.unitcost }}</td>
                        <td>{{ order.quantity }}</td>
                        <td>{{ order.total }}</td>
                      </tr>
                      <tr>
                        <td colspan="5">Tax</td>
                        <td>{{ customarAndOrderDetails.tax }}</td>
                      </tr>

                      <tr>
                        <td colspan="5">Shipping</td>
                        <td>{{ customarAndOrderDetails.Shipping }}</td>
                      </tr>
                      <tr>
                        <td colspan="5">Total</td>
                        <td>{{ customarAndOrderDetails.total }}</td>
                      </tr>

                      <tr>
                        <td colspan="5">Pay</td>

                        <td>
                          <span class="badge badge-success">{{ customarAndOrderDetails.pay }}</span>
                        </td>
                      </tr>

                      <tr>
                        <td colspan="5">Due</td>
                        <td>
                          <span class="badge badge-warning">{{
                            customarAndOrderDetails.due
                          }}</span>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
                
                <div  class="card-footer clearfix">
                  <div class="text-right">
                    <button v-if="customarAndOrderDetails.order_status == 'Pending'"  type="submit" @click="delete_Order" class="btn btn-danger " >Delete Order </button>
                    <button v-if="customarAndOrderDetails.order_status == 'Pending'"  type="submit" @click="approve_order" class="btn btn-primary" >Approve Order </button>
                    <button v-if="customarAndOrderDetails.order_status == 'Approved'"  type="submit" @click="pending_order" class="btn btn-primary" >Pending Order </button>
                  
                  </div>
                </div>
              </div>
            </div>
            <!-- /.col -->
          </div>
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  </div>
</template>

<script>
export default {
  name: "List",

  mounted() {
    this.$store.dispatch("OrderListSaveInStore");
  },

  computed: {
    getOrderListFromStore() {
      return this.$store.getters.orderListFromStore;
    },
  },
  created() {
    axios
      .get("/orderDetails/" + this.$route.params.orderId)
      .then((response) => {
        this.customarAndOrderDetails = response.data.customarAndOrderDetails;
        this.order_details = response.data.order_details;
      })
      .catch((error) => {
        this.errors = error.response.data.errors;
        // console.log(this.errors);
      });
  },
  data() {
    return {
      customarAndOrderDetails: [],
      order_details: [],
      errors: {},
    };
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
    approve_order(){
       axios.get(`/aprove_order/${this.$route.params.orderId}`).then((response) => {
          this.$router.push("/orderList");
          Toast.fire({
            icon: "success",
            title: "Order approved successfully",
          }); 
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
    pending_order(){
       axios.get(`/pending_order/${this.$route.params.orderId}`).then((response) => {
          this.$router.push("/orderList");
          Toast.fire({
            icon: "success",
            title: "Order pending successfully",
          }); 
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
    delete_Order(){
       axios.get(`/delete_Order/${this.$route.params.orderId}`).then((response) => {
          this.$router.push("/orderList");
          Toast.fire({
            icon: "success",
            title: "Order deleted successfully ",
          }); 
        }).catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
    delete_Order() {
      Swal.fire({
        title: "Are you sure?",
        text: "You want to delete this order!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios.get(`/delete_Order/${this.$route.params.orderId}`).then((response) => {
             this.$router.push("/orderList");
             Swal.fire("Deleted!", "Order deleted successfully", "success");
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