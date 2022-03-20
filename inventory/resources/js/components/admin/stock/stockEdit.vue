<template>
  <div>
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-md-8 mt-2">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title mt-1">Product Update</h3>
              </div>
              <form
                role="form"
                @submit.prevent="productUpdate"
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
                          v-if="errors && errors.category_name"
                        >
                          {{ errors.category_name[0] }}
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
                        >
                          <option
                            :value="subCategory.id"
                            v-for="subCategory in SubCategoryList"
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
                        <label for="inputName">Product Name</label>
                        <input
                          type="text"
                          v-model="product_name"
                          id="product_name"
                          name="product_name"
                          class="form-control"
                        />
                        <div
                          class="containError"
                          v-if="errors && errors.product_name"
                        >
                          {{ errors.product_name[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputName">Product Code</label>
                        <input
                          type="text"
                          v-model="product_code"
                          id="product_code"
                          name="product_code"
                          class="form-control"
                        />
                        <div
                          class="containError"
                          v-if="errors && errors.product_code"
                        >
                          {{ errors.product_code[0] }}
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputName">Product Buying Price</label>
                        <input
                          type="text"
                          v-model="product_buying_price"
                          id="product_buying_price"
                          name="product_buying_price"
                          class="form-control"
                        />
                        <div
                          class="containError"
                          v-if="errors && errors.product_buying_price"
                        >
                          {{ errors.product_buying_price[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputName">Product Selling Price</label>
                        <input
                          type="text"
                          v-model="product_selling_price"
                          id="product_selling_price"
                          name="product_selling_price"
                          class="form-control"
                        />
                        <div
                          class="containError"
                          v-if="errors && errors.product_selling_price"
                        >
                          {{ errors.product_selling_price[0] }}
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputDescription">Description</label>
                    <textarea
                      id="product_description"
                      v-model="product_description"
                      name="product_description"
                      class="form-control"
                      rows="4"
                    ></textarea>
                    <div
                      class="containError"
                      v-if="errors && errors.product_description"
                    >
                      {{ errors.product_description[0] }}
                    </div>
                  </div>
                  

                  
                  <div class="row">
                    <div class="col-md-12">
                      <fieldset class="form-group">
                        <label for="inputDescription">Publication Status</label>

                        <div class="ml-2">
                          <div class="form-check">
                            <input
                              class="form-check-input"
                              v-model="product_status"
                              type="radio"
                              name="product_status"
                              id="product_status"
                              value="1"
                            />
                            <label class="form-check-label" for="product_status">
                              Published
                            </label>
                          </div>

                          <div class="form-check">
                            <input
                              class="form-check-input"
                              v-model="product_status"
                              type="radio"
                              name="product_status"
                              id="product_status"
                              value="0"
                            />
                            <label class="form-check-label" for="product_status">
                              Unpublished
                            </label>
                          </div>
                        </div>
                        <div
                          class="containError"
                          v-if="errors && errors.product_status"
                        >
                          {{ errors.product_status[0] }}
                        </div>
                      </fieldset>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputProjectLeader">Product Image</label>
                    <input
                      type="file"
                      id="product_image"
                      name="product_image"
                      @change="getImg"
                      class="form-control"
                    />
                    <div
                      class="containError"
                      v-if="errors && errors.product_image"
                    >
                      {{ errors.product_image[0] }}
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
  //  Step: 4
  mounted() {
    this.$store.dispatch("CategoryListSaveInStore");
  },
  created() {
    axios.get("/SubCategoryList").then((response) => {
      this.SubCategoryList = response.data.SubCategoryList;
    });

    axios
      .get("/productById/" + this.$route.params.productId)
      .then((response) => {
        this.category_id = response.data.productById.category_id;
        this.sub_category_id = response.data.productById.sub_category_id;
        this.product_name = response.data.productById.product_name;
        this.product_description = response.data.productById.product_description;
        this.product_code = response.data.productById.product_code;
        this.product_buying_price = response.data.productById.product_buying_price;
        this.product_selling_price = response.data.productById.product_selling_price;
        this.product_status = response.data.productById.product_status;
        this.product_image = response.data.productById.product_image;
      });
  },

  //  Step: 10
  computed: {
    getCategoryListFromStore() {
      return this.$store.getters.categoryListFromStore;
    },
  },
  data() {
    return {
      SubCategoryList: [],

      category_id: "",
      sub_category_id: "",
      product_name: "",
      product_description: "",
      product_code: "",
      product_buying_price: "",
      product_selling_price: "",
      product_image: "",
      product_status: "",
      errors: {},
    };
  },

  methods: {
    getSubCategory() {
      axios
        .get("/getSubcategoryByCategoryId/" + this.category_id)
        .then((response) => {
          this.SubCategoryList = response.data.subCategoryListById;
        });
    },

    getImg(e) {
      this.product_image = e.target.files[0];
      if (this.product_image.size > 2097152) {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "File is larger than 2MB!",
        });
      } else if (!e.target.files[0].name.match(/.(jpg|jpeg|png|gif)$/i)) {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Image extension is not support. Allow Extension is jpeg, jpg, png and gif",
        });
      } else {
      }
    },

    productUpdate() {
      let form = new FormData();
    
      form.append("category_id", this.category_id);
      form.append("sub_category_id", this.sub_category_id);
      form.append("product_name", this.product_name);
      form.append("product_description", this.product_description);
      form.append("product_code", this.product_code);
      form.append("product_buying_price", this.product_buying_price);
      form.append("product_selling_price", this.product_selling_price);
      form.append("product_image", this.product_image);
      form.append("product_status", this.product_status);

      axios
        .post(`/productUpdate/${this.$route.params.productId}`, form)
        .then((response) => {
          this.$router.push("/productList");
          Toast.fire({
            icon: "success",
            title: "Product update successfully",
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