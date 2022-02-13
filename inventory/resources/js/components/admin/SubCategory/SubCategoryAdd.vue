<template>
  <div>
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-md-6 mt-2">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title mt-1">Sub Category Add</h3>
              </div>
              <form
                role="form"
                @submit.prevent="SubCategorySave"
                enctype="multipart/form-data"
              >
                <div class="card-body">
                   <div class="form-group">
                      <label for="exampleInputEmail1">Select Category</label>
                      <select type="text" v-model="cat_id" class="form-control" id="exampleInputEmail1" name="cat_id" >
                        <option :value="category.id"  v-for="category in getCategoryListFromStore" :key="category.id">
                          {{ category.cat_name }}
                        </option>
                      </select>
                          <div class="containError" v-if="errors && errors.cat_id">
                                {{ errors.cat_id[0] }}
                          </div>
                    </div>

                  <div class="form-group">
                    <label for="inputName">Sub Category Name</label>
                    <input
                      type="text"
                      v-model="sub_cat_name"
                      id="sub_cat_name"
                      name="sub_cat_name"
                      class="form-control"
                    />
                    <div class="containError" v-if="errors && errors.sub_cat_name">
                      {{ errors.sub_cat_name[0] }}
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputDescription">Sub Category Description</label>
                    <textarea
                      id="sub_cat_description"
                      v-model="sub_cat_description"
                      name="sub_cat_description"
                      class="form-control"
                      rows="4"
                    ></textarea>
                    <div
                      class="containError"
                      v-if="errors && errors.sub_cat_description"
                    >
                      {{ errors.sub_cat_description[0] }}
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputProjectLeader">Sub Category Image</label>
                    <input
                      type="file"
                      id="sub_cat_img"
                      name="sub_cat_img"
                      @change="getImg"
                      class="form-control"
                    />
                    <div class="containError" v-if="errors && errors.sub_cat_img">
                      {{ errors.sub_cat_img[0] }}
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

  //  Step: 10
  computed: {
    getCategoryListFromStore() {
      return this.$store.getters.categoryListFromStore;
    },
  },


  data() {
    return {
      cat_id:"",
      sub_cat_name: "",
      sub_cat_description: "",
      sub_cat_img: "",
      errors: {},
    };
  },

  methods: {
    getImg(e) {
      this.sub_cat_img = e.target.files[0];
      if (this.sub_cat_img.size > 2097152) {
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

    SubCategorySave() {
      let form = new FormData();
      form.append("cat_id", this.cat_id);
      form.append("sub_cat_name", this.sub_cat_name);
      form.append("sub_cat_description", this.sub_cat_description);
      form.append("sub_cat_img", this.sub_cat_img);

      axios
        .post("/SubCategoryStore", form)
        .then((response) => {
          this.$router.push("/SubCategoryList");
          Toast.fire({
            icon: "success",
            title: "Sub Category added successfully",
          });
          // console.log(response);
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          console.log(this.error);
        });
    },

    goBack() {
      this.$router.push("/SubCategoryList");
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