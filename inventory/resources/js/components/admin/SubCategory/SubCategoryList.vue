<template>
  <div>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <section class="content">
        <!--/. container-fluid -->
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-md-9 mt-3">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Category List</h3>
                  <div class="text-right">
                    <router-link
                      to="/SubCategoryAdd"
                      class="btn btn-primary btn-sm"
                      >Add</router-link
                    >
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Category Name</th>
                        <th>Sub Category Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(SubCategoryList, x) in getCategoryListFromStore"
                        :key="SubCategoryList.id"
                      >
                        <td>{{ x + 1 }}</td>
                        <td>{{ SubCategoryList.cat_name }}</td>
                        <td>{{ SubCategoryList.sub_cat_name }}</td>
                        <td>{{ SubCategoryList.sub_cat_description }}</td>
                        <td>
                          <img
                            v-bind:src="`/images/subCategory/${SubCategoryList.sub_cat_img}`"
                            class="image"
                          />
                        </td>
                        <!-- <img src="./assets/images/01.jpg" alt=""> -->

                        <td>
                          <div class="">
                            <router-link
                              :to="`/SubCategoryEdit/${SubCategoryList.id}`"
                              class="btn btn-info btn-xs"
                              ><i class="fas fa-edit"></i
                            ></router-link>
                            <a
                              @click.prevent="
                                SubCategoryDelete(SubCategoryList.id)
                              "
                              class="btn btn-info btn-xs"
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

  //  Step: 4
  mounted() {
    this.$store.dispatch("SubCategoryListSaveInStore");
  },

  //  Step: 10
  computed: {
    getCategoryListFromStore() {
      return this.$store.getters.SubCategoryListFromStore;
    },
  },

  methods: {
    SubCategoryDelete(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You want to delete this sub category!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios.get("/SubCategoryDelete/" + id).then((response) => {
            this.$store.dispatch("SubCategoryListSaveInStore");
            Swal.fire(
              "Deleted!",
              "Sub Category deleted successfully",
              "success"
            );
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