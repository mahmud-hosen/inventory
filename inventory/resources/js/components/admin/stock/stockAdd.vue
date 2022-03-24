
<template>
  <div>
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-md-8 mt-2">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title mt-1">Stock Add</h3>
              </div>
              <form
                role="form"
                @submit.prevent="StockSave"
                enctype="multipart/form-data"
              >
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Select Category</label>
                        <select
                          type="text"
                          v-model="category_id"
                          class="form-control"
                          id="exampleInputEmail1"
                          name="category_id"
                          @change="getSubCategory"
                        >
                          <option
                            :value="category.id"
                            v-for="category in getCategoryListFromStore"
                            :key="category.id"
                          >
                            {{ category.category_name }}
                          </option>
                        </select>
                        <div
                          class="containError"
                          v-if="errors && errors.category_id"
                        >
                          {{ errors.category_id[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1"
                          >Select Sub Category</label
                        >
                        <select
                          type="text"
                          v-model="sub_category_id"
                          class="form-control"
                          id="exampleInputEmail1"
                          name="category_id"
                          @change="getProduct"
                        >
                          <option
                            :value="subCategory.id"
                            v-for="subCategory in subCategoryList"
                            :key="subCategory.id"
                          >
                            {{ subCategory.sub_category_name }}
                          </option>
                        </select>
                        <div
                          class="containError"
                          v-if="errors && errors.sub_category_id"
                        >
                          {{ errors.sub_category_id[0] }}
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Select Product</label>
                        <select
                          type="text"
                          v-model="product_id"
                          class="form-control"
                          id="exampleInputEmail1"
                          name="product_id"
                        >
                          <option
                            :value="product.id"
                            v-for="product in productList"
                            :key="product.id"
                          >
                            {{ product.product_name }}
                          </option>
                        </select>
                        <div
                          class="containError"
                          v-if="errors && errors.product_id"
                        >
                          {{ errors.product_id[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputName">Company Name</label>
                        <input
                          type="text"
                          v-model="company_name"
                          id="company_name"
                          name="company_name"
                          class="form-control"
                        />
                        <div
                          class="containError"
                          v-if="errors && errors.company_name"
                        >
                          {{ errors.company_name[0] }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputName">Quantity</label>
                        <input type="text" v-model="product_quantity" @keyup="productCost" id="product_quantity" name="product_quantity" class="form-control" />
                        <div  class="containError"  v-if="errors && errors.product_quantity" >
                          {{ errors.product_quantity[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputName">Unit Cost</label>
                        <input
                          type="text"
                          v-model="product_unit_cost" @keyup="productCost"
                          id="product_unit_cost"
                          name="product_unit_cost"
                          class="form-control"
                        />
                        <div
                          class="containError"
                          v-if="errors && errors.product_unit_cost"
                        >
                          {{ errors.product_unit_cost[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="inputName">Total</label>
                        <input
                          type="text"
                          v-model="product_total_price"
                          id="product_total_price"
                          name="product_total_price"
                          class="form-control"
                        />
                        <div
                          class="containError"
                          v-if="errors && errors.product_total_price"
                        >
                          {{ errors.product_total_price[0] }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputName">Paid</label>
                        <input
                          type="text"
                          v-model="paid" @keyup="paidAmount"
                          id="paid"
                          name="paid"
                          class="form-control"
                        />
                        <div class="containError" v-if="errors && errors.paid">
                          {{ errors.paid[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputName">Due</label>
                        <input
                          type="text"
                          v-model="due"
                          id="due"
                          name="due"
                          class="form-control"
                        />
                        <div class="containError" v-if="errors && errors.due">
                          {{ errors.due[0] }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="inputName">Stock Date</label>
                        <input
                          type="date"
                          v-model="stock_date"
                          id="stock_date"
                          name="stock_date"
                          class="form-control"
                        />
                        <div
                          class="containError"
                          v-if="errors && errors.stock_date"
                        >
                          {{ errors.stock_date[0] }}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-primary btn-sm">
                    Submit
                  </button>
                  <button
                    type="submit"
                    @click="goBack"
                    class="btn btn-danger btn-sm px-3"
                  >
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
      category_id: "",
      sub_category_id: "",

      product_id: "",
      company_name: "",

      product_quantity: "",
      product_unit_cost: "",
      product_total_price: "",

      paid: "",
      due: "",

      stock_date: "",
      errors: {},
    };
  },

  methods: {
    productCost()
    {
      this.product_total_price = this.product_quantity * this.product_unit_cost;

    },
    paidAmount()
    {
      this.due = this.product_total_price - this.paid;
    },

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
        });
    },

    StockSave() {
      let form = new FormData();
      form.append("product_id", this.product_id);
      form.append("company_name", this.company_name);
      form.append("product_quantity", this.product_quantity);
      form.append("product_unit_cost", this.product_unit_cost);
      form.append("product_total_price", this.product_total_price);
      form.append("paid", this.paid);
      form.append("due", this.due);
      form.append("stock_date", this.stock_date);

      axios
        .post("/stockStore", form)
        .then((response) => {
          this.$router.push("/productList");
          Toast.fire({
            icon: "success",
            title: "Stock added successfully",
          });
          // console.log(response);
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          console.log(this.error);
        });
    },

    goBack() {
      this.$router.push("/productList");
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