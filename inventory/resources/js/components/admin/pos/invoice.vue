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
                        <td>{{subTotal*0.05}}</td>
                      </tr>
                      <tr>
                        <th>Shipping:</th>
                        <td>$30</td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>{{subTotal+subTotal*0.05+30}}</td>
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
                  <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  </div>
</template>

<script>
export default {
   
   created() {
    axios.get("/createInvoice/" + this.$route.params.customerId).then((response) => {
        console.log(response);
        this.cartProductsList = response.data.cartProductsList;
        this.customerDetails = response.data.customerDetails;
        this.cartTotalQuantity = response.data.cartTotalQuantity;
        this.subTotal = response.data.subTotal;
        this.total = response.data.total;
        }).catch((error) => {
          this.errors = error.response.data.errors;
          console.log(this.errors);
        });
  },


  data() {
    return {
      cartProductsList: [],
      customerDetails:[],
      cartTotalQuantity: "",
      subTotal: "",
      total: "",
      errors: {},
     
    };
  },

  methods: {
   
  },
};
</script>

<style>

</style>