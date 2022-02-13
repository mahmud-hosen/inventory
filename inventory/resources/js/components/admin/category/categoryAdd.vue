<template>
  <div>
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-md-6 mt-2">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title mt-1">Category Add</h3>
              </div>
              <form
                role="form"
                @submit.prevent="categorySave"
                enctype="multipart/form-data"
              >
                <div class="card-body">
                  <div class="form-group">
                    <label for="inputName">Category Name</label>
                    <input type="text" v-model="cat_name" id="cat_name" name="cat_name" class="form-control"/>
                    <div class="containError" v-if="errors && errors.cat_name">
                      {{ errors.cat_name[0] }}
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputDescription">Category Description</label>
                    <textarea
                      id="cat_description"
                      v-model="cat_description"
                      name="cat_description"
                      class="form-control"
                      rows="4"
                    ></textarea>
                    <div
                      class="containError"
                      v-if="errors && errors.cat_description"
                    >
                      {{ errors.cat_description[0] }}
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputProjectLeader">Category Image</label>
                    <input
                      type="file"
                      id="cat_img"
                      name="cat_img"
                      @change="getImg"
                      class="form-control"
                    />
                    <div class="containError" v-if="errors && errors.cat_img">
                      {{ errors.cat_img[0] }}
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
  data() {
    return {
      cat_name: "",
      cat_description: "",
      cat_img: "",
      errors: {},
    };
  },

  methods: {
    getImg(e) {
      this.cat_img = e.target.files[0];
      if (this.cat_img.size > 2097152) {
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

    categorySave() {
      let form = new FormData();
      form.append("cat_name", this.cat_name);
      form.append("cat_description", this.cat_description);
      form.append("cat_img", this.cat_img);

      axios
        .post("/categoryStore", form)
        .then((response) => {
          this.$router.push("/categoryList");
          Toast.fire({
            icon: "success",
            title: "Category added successfully",
          });
          // console.log(response);
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          console.log(this.error);
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
</style>