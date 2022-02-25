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
                      <a class="btn btn-primary btn-sm" @click.prevent="clearCart">Clear</a >
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
                        <td>{{ product.quantity }}</td>

                        
                      </tr>
                       <tr>
                        <td colspan="2" class="text-center">Total</td>
                        <th>{{total}}</th>
                        <th>{{cartTotalQuantity}}</th>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
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
                            <a
                              @click.prevent="addCart(product.id)"
                              class="btn btn-info btn-sm"
                              ><i class="fas fa-shopping-cart"></i>
                            </a>
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
  //  Step: 4
  mounted() {
    this.$store.dispatch("CategoryListSaveInStore");
  },

  //  Step: 10
  computed: {
    getCategoryListFromStore() {
      return this.$store.getters.categoryListFromStore;
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
      axios
        .get("/getProductBySubCategoryId/" + this.sub_category_id)
        .then((response) => {
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
    clearCart() {
      axios.get("/clearCart/").then((response) => {
        this.cartProducts = response.data.cartProducts;
        this.cartTotalQuantity = response.data.cartTotalQuantity;
        this.subTotal = response.data.subTotal;
        this.total = response.data.total;

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