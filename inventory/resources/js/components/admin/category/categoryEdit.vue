
<template>
  <div>
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-md-6 mt-2">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title mt-1">Category Update</h3>
              </div>
              <form
                role="form"
                @submit.prevent="categoryUpdate"
                enctype="multipart/form-data"
              >
                <div class="card-body">
                  <div class="form-group">
                    <label for="inputName"> Name</label>
                    <input
                      type="text"
                      v-model="category_name"
                      id="category_name"
                      name="category_name"
                      class="form-control"
                    />
                    <div
                      class="containError"
                      v-if="errors && errors.category_name"
                    >
                      {{ errors.category_name[0] }}
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputDescription">Category Description</label>
                    <textarea
                      id="category_description"
                      v-model="category_description"
                      name="category_description"
                      class="form-control"
                      rows="4"
                    ></textarea>
                    <div
                      class="containError"
                      v-if="errors && errors.category_description"
                    >
                      {{ errors.category_description[0] }}
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputProjectLeader">Category Image</label>
                    <input
                      type="file"
                      id="category_image"
                      name="category_image"
                      @change="getImage"
                      class="form-control"
                    />
                    <div
                      class="containError"
                      v-if="errors && errors.category_image"
                    >
                      {{ errors.category_image[0] }}
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
  name: "Edit",

  created() {
    axios
      .get("/categoryById/" + this.$route.params.categoryId)
      .then((response) => {
        this.category_name = response.data.categoryById.category_name;
        this.category_description =
          response.data.categoryById.category_description;
        this.category_image = response.data.categoryById.category_image;
      });
  },

  data() {
    return {
      category_name: "",
      category_description: "",
      category_image: "",
      errors: {},
    };
  },

  methods: {
    getImage(e) {
      this.category_image = e.target.files[0];
      if (this.category_image.size > 2097152) {
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

    categoryUpdate() {
      let form = new FormData();
      form.append("category_name", this.category_name);
      form.append("category_description", this.category_description);
      form.append("category_image", this.category_image);

      axios.post(`/categoryUpdate/${this.$route.params.categoryId}`, form).then((response) => {
          this.$router.push("/categoryList");
          Toast.fire({
            icon: "success",
            title: "Category Updated successfully",
          });
          
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },

    goBack() {
      this.$router.push("/categoryList");
      // this.$router.push("/category");
    },
  },
};
</script>

<style>
.containError {
  color: red;
}
.image {
  height: 60px;
  width: 100px;
}
</style>