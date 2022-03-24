<template>
  <div>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <section class="content">
        <!--/. container-fluid -->
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Product List</h3>
                  <div class="text-right">
                    <router-link to="/productAdd" class="btn btn-primary btn-sm"
                      >Add
                    </router-link>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  
                   <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Select Category</label>
                        <select  type="text"  v-model="category_id"  class="form-control"  id="exampleInputEmail1"  name="category_id"  @change="getSubCategory"  >
                          <option  :value="category.id" v-for="category in getCategoryListFromStore"  :key="category.id"  >
                            {{ category.category_name }}
                          </option>
                        </select>
                        <div  class="containError"  v-if="errors && errors.category_id"  >
                          {{ errors.category_id[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1" >Select Sub Category</label >
                        <select type="text" v-model="sub_category_id" class="form-control" id="exampleInputEmail1" name="category_id" @change="getProduct" >
                          <option  :value="subCategory.id"  v-for="subCategory in subCategoryList"  :key="subCategory.id"  >
                            {{ subCategory.sub_category_name }}
                          </option>
                        </select>
                        <div  class="containError"  v-if="errors && errors.sub_category_id" >
                          {{ errors.sub_category_id[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group"> <label for="exampleInputEmail1">Select Product</label>
                        <select  type="text"  v-model="product_id" @change="StockProducts"  class="form-control"  id="exampleInputEmail1"  name="product_id"  >
                          <option :value="product.id"  v-for="product in productList"  :key="product.id" >
                            {{ product.product_name }}
                          </option>
                        </select>
                        <div class="containError" v-if="errors && errors.product_id" >
                          {{ errors.product_id[0] }}
                        </div>
                      </div>
                    </div>
                 
                  </div>

                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Product Name</th>
                        <th>Company Name</th>
                        <th>Quantity</th>
                        <th>Unit Cost</th>
                        <th>Total</th>
                        <th>Paid</th>
                        <th>Due</th>
                        <th>Stock Date</th>

                        
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(productList, x) in StockProductList" :key="productList.id" >
                        <td>{{ x + 1 }}</td>
                        <td>{{ productList.product_name }}</td>
                        <td>{{ productList.company_name }}</td>
                        <td>{{ productList.product_quantity }}</td>
                        <td>{{ productList.product_unit_cost }}</td>
                        <td>{{ productList.product_total_price }}</td>
                        <td>{{ productList.paid }}</td>
                        <td>{{ productList.due }}</td>
                        <td>{{ productList.stock_date }}</td>


                        <td class="text-right py-0 align-middle">
                          <div class="btn-group btn-group-sm">
                            <router-link
                              :to="`/StockEdit/${productList.id}`"
                              class="btn btn-info"
                              ><i class="fas fa-edit"></i
                            ></router-link>
                            <a
                              @click.prevent="storeDelete(productList.id)"
                              class="btn btn-danger"
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

  mounted() {
    this.$store.dispatch("CategoryListSaveInStore");
  },

  computed: {
    getCategoryListFromStore() {
      return this.$store.getters.categoryListFromStore;
    },
  },
  data() {
    return {
      subCategoryList: [],
      productList: [],
      StockProductList:[],
      category_id: "",
      sub_category_id: "",
      product_id: "",     

      errors: {},
    };
  },

  methods: {
    getSubCategory() {
      axios.get("/getSubcategoryByCategoryId/" + this.category_id)
        .then((response) => {
          this.subCategoryList = response.data.subCategoryListById;
        });
    },

    getProduct() {
      axios.get("/getProductBySubCategoryId/" + this.sub_category_id)
        .then((response) => {
          this.productList = response.data.productListBySubCategoryId;
          console.log(this.productList);
        });
    },
    
    StockProducts() {
      axios.get("/getStoreProduct/" + this.product_id).then((response) => {
          this.StockProductList = response.data.storeProducts;
        });
    },

    storeDelete(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You want to delete this stock!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios.get("/stocktDelete/" + id).then((response) => {
            // this.$store.dispatch("productListSaveInStore");
            Swal.fire("Deleted!", "Stock deleted successfully", "success");
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