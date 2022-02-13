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
                          v-model="cat_id"
                          class="form-control"
                          id="exampleInputEmail1"
                          name="cat_id"
                          @change="getSubCategory"
                        >
                          <option
                            :value="category.id"
                            v-for="category in getCategoryListFromStore"
                            :key="category.id"
                          >
                            {{ category.cat_name }}
                          </option>
                        </select>
                        <div
                          class="containError"
                          v-if="errors && errors.cat_id"
                        >
                          {{ errors.cat_id[0] }}
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
                          v-model="sub_cat_id"
                          class="form-control"
                          id="exampleInputEmail1"
                          name="sub_cat_id"
                        >
                          <option
                            :value="subCategory.id"
                            v-for="subCategory in SubCategoryList"
                            :key="subCategory.id"
                          >
                            {{ subCategory.sub_cat_name }}
                          </option>
                        </select>
                        <div
                          class="containError"
                          v-if="errors && errors.sub_cat_id"
                        >
                          {{ errors.sub_cat_id[0] }}
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
                        <label for="inputName">Price</label>
                        <input
                          type="text"
                          v-model="product_price"
                          id="product_price"
                          name="product_price"
                          class="form-control"
                        />
                        <div
                          class="containError"
                          v-if="errors && errors.product_price"
                        >
                          {{ errors.product_price[0] }}
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputDescription">Description</label>
                    <textarea
                      id="description"
                      v-model="description"
                      name="description"
                      class="form-control"
                      rows="4"
                    ></textarea>
                    <div
                      class="containError"
                      v-if="errors && errors.description"
                    >
                      {{ errors.description[0] }}
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
                              v-model="status"
                              type="radio"
                              name="status"
                              id="status"
                              value="1"
                            />
                            <label class="form-check-label" for="status">
                              Published
                            </label>
                          </div>

                          <div class="form-check">
                            <input
                              class="form-check-input"
                              v-model="status"
                              type="radio"
                              name="status"
                              id="status"
                              value="0"
                            />
                            <label class="form-check-label" for="status">
                              Unpublished
                            </label>
                          </div>
                        </div>
                        <div
                          class="containError"
                          v-if="errors && errors.status"
                        >
                          {{ errors.status[0] }}
                        </div>
                      </fieldset>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputProjectLeader">Product Image</label>
                    <input
                      type="file"
                      id="product_img"
                      name="product_img"
                      @change="getImg"
                      class="form-control"
                    />
                    <div
                      class="containError"
                      v-if="errors && errors.product_img"
                    >
                      {{ errors.product_img[0] }}
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

    axios.get("/productById/"+this.$route.params.productId)
      .then((response) => {
        this.cat_id = response.data.productById.cat_id;
        this.sub_cat_id = response.data.productById.sub_cat_id;
        this.product_price = response.data.productById.product_price;
        this.product_name = response.data.productById.product_name;
        this.description = response.data.productById.description;
        this.status = response.data.productById.status;
        this.product_img = response.data.productById.product_img;
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
      
      cat_id: '',
      sub_cat_id: '',
      product_price: '',
      product_name: '',
      description: '',
      product_img: '',
      status: '',
      errors: {},
    };
  },

  

  methods: {

     getSubCategory() {
      axios.get("/getSubcategoryByCategoryId/" + this.cat_id)
        .then((response) => {
          this.SubCategoryList = response.data.subCategoryListById;
        });
    },

    getImg(e) {
      this.product_img = e.target.files[0];
      if (this.product_img.size > 2097152) {
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
      form.append("cat_id", this.cat_id);
      form.append("sub_cat_id", this.sub_cat_id);
      form.append("product_price", this.product_price);
      form.append("product_name", this.product_name);
      form.append("description", this.description);
      form.append("product_img", this.product_img);
      form.append("status", this.status);

        axios.post(`/productUpdate/${this.$route.params.productId}`, form)

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