<template>
  <div>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
           
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> AdminLTE, Inc.
                    <small class="float-right">Date: 2/10/2014</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>Admin, Inc.</strong><br>
                    Address: Dhaka Uttara<br>
                    Phone: 01787315406<br>
                    Email: mahmud@gmail.com
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong><span>Name: </span>{{customerDetails.customer_name}}</strong><br>
                    <span>Address: </span>{{customerDetails.customer_address}}<br>
                    <span>Phone: </span> {{customerDetails.customer_phone}}<br>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice #007612</b><br>
                  <b>Order ID:</b> 4F3S8J<br>
                  <b>Payment Due:</b> 2/22/2014<br>
                  <b>Account:</b> 968-34567
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>SI</th>
                      <th>Product</th>
                      <th>Price</th>
                      <th>Qty</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(product, x) in cartProductsList" :key="product.id">
                        <td>{{ x + 1 }}</td>
                        <td>{{ product.name }}</td>
                        <td>{{ product.price }}</td>
                        <td>{{ product.quantity }}</td>
                        <td>{{ product.quantity*product.price }}</td>
                      </tr>
                   
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Methods:</p>
                  <img src="/admin/dist/img/credit/visa.png" alt="Visa">
                  <img src="/admin/dist/img/credit/mastercard.png" alt="Mastercard">
                  <img src="/admin/dist/img/credit/american-express.png" alt="American Express">
                  <img src="/admin/dist/img/credit/paypal2.png" alt="Paypal">

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                    plugg
                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Amount Due 2/22/2014</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>{{subTotal}}</td>
                      </tr>
                      <tr>
                        <th>Tax (5%)</th>
                        <td>{{tax}}</td>
                      </tr>
                      <tr>
                        <th>Shipping:</th>
                        <td>{{Shipping}}</td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>{{total}}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#modal-default"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button>
                  <!-- <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                    Launch Default Modal
                 </button> -->

                  <a type="button" @click.prevent="GeneratePDF" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </a>
                  <!-- <a @click.prevent="GeneratePDF()" class="btn btn-info btn-xs" ><i class="fas fa-trash"></i></a> -->
                 
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- Payment Modal Start  -->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Payment</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <h4 class="text-center">Totall:{{total}}</h4>
            <div class="modal-body">
                         <div class="row">
                                <div class="col-md-6 mt-4">
                                    <select v-model="payment_method" name="payment_method" class="form-control " id="payment_status" required>
                                        <option value="" disabled="" selected="">Select Payment Method </option>
                                        <option value="handCash">HandCash </option>
                                        <option value="cheque">Cheque </option>
                                        <option value="due">Due </option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Pay</label>
                                         <input type="number" v-model="pay" name="pay" @keyup="paymentAmount" id="pay"  class="form-control" >
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Due</label>
                                         <input type="text" v-model="due" name="due" id="due"  class="form-control" disabled>
                                    </div>
                                </div>
                         </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" @click.prevent="confirm_order" class="btn btn-primary" >Confirm Order</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    <!-- Paymeny Modeal End-->


  </div>
  </div>
  
</template>

<script>
export default {
   
   created() {
    axios.get("/createInvoice/" + this.$route.params.customerId).then((response) => {
        this.cartProductsList = response.data.cartProductsList;
        this.customerDetails = response.data.customerDetails;
        this.cartTotalQuantity = response.data.cartTotalQuantity;
        this.subTotal = response.data.subTotal;
        this.tax = response.data.subTotal*0.05;
        this.Shipping = 30;
        this.total = this.subTotal+this.tax+this.Shipping;
        }).catch((error) => {
          this.errors = error.response.data.errors;
          // console.log(this.errors);
        });
  },


  data() {
    return {
      customerId:"",
      cartProductsList: [],
      customerDetails:[],
      cartTotalQuantity: "",
      order_date:"",
      payment_method:"",
      Shipping:"",
      tax:"",
      pay:"",
      due:"",
      subTotal: "",
      total: "",
      errors: {},
     
    };
  },

  methods: {
    GeneratePDF(){
          let form = new FormData();
          form.append("customer_name", this.customerDetails.customer_name);
          form.append("customer_address", this.customerDetails.customer_address);
          form.append("customer_phone", this.customerDetails.customer_phone);

          form.append("customerId", this.$route.params.customerId);
          form.append("Shipping", this.Shipping);
          form.append("tax", this.tax);
          form.append("total", this.total);

         axios.post("/GeneratePDF/",form).then((response) => {
        // this.cartProductsList = response.data.cartProductsList;
         }).catch((error) => {
          // this.errors = error.response.data.errors;
          // console.log(this.errors);
        });
    },
     paymentAmount() {
       this.due = this.total-this.pay;
    },
      confirm_order(){
          let form = new FormData();
          
          form.append("customerId", this.$route.params.customerId);
          form.append("order_status","Pending");
          form.append("payment_status","Due");
          form.append("payment_method", this.payment_method);
          form.append("Shipping", this.Shipping);
          form.append("tax", this.tax);
          form.append("pay", this.pay);
          form.append("due", this.due);
          form.append("subTotal", this.subTotal);
          form.append("total", this.total);

        
         axios.post("/confirm_order", form).then((response) => {
          this.$router.push("/pos");
          Toast.fire({
            icon: "success",
            title: "Order Created Successfully ",
          });
          // console.log(response);
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          console.log(this.error);
        });
    },
   
  },
};
</script>

<style>

</style>