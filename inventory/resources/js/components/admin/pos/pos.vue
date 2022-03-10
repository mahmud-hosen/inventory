<template>
  <div>
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 mt-2">
              <div class="card bg-info text-center">
                <h2 class="card-title mt-1 mb-1">POS (Point of Sale)</h2>
                <h2 class="card-title">Date: 23-03-1999</h2>
              </div>
              <!-- /.card -->
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Products</h3>
                  <div class="text-right">
                    <a class="btn btn-primary btn-sm" @click.prevent="clearCart"
                      >Clear</a
                    >
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">SI</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Action</th>

                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(product, x) in cartProducts"
                        :key="product.id"
                      >
                        <td>{{ x + 1 }}</td>
                        <td>{{ product.name }}</td>
                        <td>{{ product.price }}</td>
                        <td>
                          <input class="w-100 form-conrol" min="1" type="number" name="quantity" v-model="product.quantity" @change="updateCart(product.id,product.quantity)">  
                        </td>
                        <td>
                          <div class="">
                            <a @click.prevent="removeItem(product.id)" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                          </div>
                        </td>
                        

                      </tr>
                      <tr>
                        <td colspan="2" class="text-center">Total</td>
                        <th>{{ total }}</th>
                        <th>{{ cartTotalQuantity }}</th>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer">
                  <div class="row">
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <select  type="text"  v-model="customer_id" class="form-control select2bs4" name="customer_id" style="width: 100%">
                          <option selected="selected" disabled="disabled">
                            Select a Customer
                          </option>

                          <option :value="customer.id" v-for="customer in getCustomerListFromStore"  :key="customer.id"  >
                            {{ customer.customer_name }}
                          </option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                       <router-link to="/customerAdd" class="btn btn-info float-right">Add Customer</router-link>
                      
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <router-link :to="`/createInvoice/${this.customer_id}`" class="btn btn-info btn-block">Create Invoice</router-link>
                       
                    </div>
                  </div>
                  
                </div>
              </div>
              <!-- /.card -->
            </div>

            <!-- Product Cart -->
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <select
                          type="text"
                          v-model="category_id"
                          class="form-control select2bs4"
                          id="exampleInputEmail1"
                          name="category_id"
                          @change="getSubCategory"
                          style="width: 100%"
                        >
                          <option selected="selected" disabled="disabled">
                            Select a Category
                          </option>
                          <option
                            :value="category.id"
                            v-for="category in getCategoryListFromStore"
                            :key="category.id"
                          >
                            {{ category.category_name }}
                          </option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <select
                          type="text"
                          v-model="sub_category_id"
                          @change="getProduct"
                          class="form-control select2bs4"
                          id="exampleInputEmail1"
                          name="category_id"
                          style="width: 100%"
                        >
                          <option selected="selected" disabled="disabled">
                            Select Sub Category
                          </option>

                          <option
                            :value="subCategory.id"
                            v-for="subCategory in subCategoryList"
                            :key="subCategory.id"
                          >
                            {{ subCategory.sub_category_name }}
                          </option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                  <div class="input-group input-group-sm mb-1">
                    <input  v-model="serachValue" name="serachValue" @keyup="serachProduct"  class="form-control form-control" type="search" placeholder="Search" aria-label="Search"> 
                  </div>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">SI</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Cart</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(product, x) in productList" :key="product.id">
                        <td>{{ x + 1 }}</td>
                        <td>{{ product.product_name }}</td>
                        <td>{{ product.product_selling_price }}</td>
                        <td>
                          <img
                            v-bind:src="`/images/product/${product.product_image}`"
                            class="image"
                          />
                        </td>

                        <td>
                          <div class="">
                            <a @click.prevent="addCart(product.id)" class="btn btn-info btn-sm"><i class="fas fa-shopping-cart"></i></a>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                  <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item">
                      <a class="page-link" href="#">&laquo;</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">&raquo;</a>
                    </li>
                  </ul>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
  </div>
</template>

<script>
export default {

  mounted() {
    this.$store.dispatch("CategoryListSaveInStore");
    this.$store.dispatch("customerListSaveInStore");

  },

  computed: {
    getCategoryListFromStore() {
      return this.$store.getters.categoryListFromStore;
    },
    getCustomerListFromStore() {
      return this.$store.getters.customerListFromStore;
    },
  },

   

  data() {
    return {
      subCategoryList: [],
      productList: [],
      cartProducts: [],
      cartTotalQuantity: "",
      subTotal: "",
      total: "",

      category_id: "",
      sub_category_id: "",
      product_name: "",
      serachValue:"",

      customer_id:"",
      errors: {},
    };
  },
  methods: {
    getSubCategory() {
      axios
        .get("/getSubcategoryByCategoryId/" + this.category_id)
        .then((response) => {
          this.subCategoryList = response.data.subCategoryListById;
        });
    },
    getProduct() {
      axios.get("/getProductBySubCategoryId/" + this.sub_category_id).then((response) => {
          this.productList = response.data.productListBySubCategoryId;
        });
    },
    addCart(id) {
      axios.get("/productAddToCart/" + id).then((response) => {
        this.cartProducts = response.data.cartProducts;
        this.cartTotalQuantity = response.data.cartTotalQuantity;
        this.subTotal = response.data.subTotal;
        this.total = response.data.total;

        // console.log(response.data.cartTotalQuantity);
      });
    },

    removeItem(id) {
      axios.get("/removeItemFromCart/" + id).then((response) => {
        this.cartProducts = response.data.cartProducts;
        this.cartTotalQuantity = response.data.cartTotalQuantity;
        this.subTotal = response.data.subTotal;
        this.total = response.data.total;
      });
    },


    clearCart() {
      axios.get("/clearCart/").then((response) => {
        this.cartProducts = response.data.cartProducts;
        this.cartTotalQuantity = response.data.cartTotalQuantity;
        this.subTotal = response.data.subTotal;
        this.total = response.data.total;
      });
    },
    
    serachProduct() {

      axios.get("/getProductBySearch/" + this.serachValue).then((response) => {
          this.productList = response.data.productListBySearch;
        });
    },
    

     updateCart(id,quantity) {
      let form = new FormData();
      form.append("id",id);
      form.append("quantity",quantity);

      axios.post("/updateCart", form).then((response) => {
        this.cartProducts = response.data.cartProducts;
        this.cartTotalQuantity = response.data.cartTotalQuantity;
        this.subTotal = response.data.subTotal;
        this.total = response.data.total;
        
          // console.log(response);
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          console.log(this.error);
        });
    },
   


    // goBack() {
    //   this.$router.push("/productList");
    // },
  },
};
</script>

<style>
</style>