<template>
  <div>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <section class="content">
        <!--/. container-fluid -->
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-md-7 mt-3">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Category List</h3>
                  <div class="text-right">
                    <router-link
                      to="/categoryAdd"
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
                        <th>Description</th>
                        <th>Image</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(CategoryList, x) in getCategoryListFromStore" :key="CategoryList.id"  >
                        <td>{{x+1}}</td>
                        <td>{{CategoryList.cat_name}}</td>
                        <td>{{CategoryList.cat_description}}</td>
                        <td><img v-bind:src="`/images/category/${CategoryList.cat_img}`" class="image"></td>
                        <!-- <img src="./assets/images/01.jpg" alt=""> -->



                        <td>
                          <div class="">
                            <router-link
                              :to="`/editCategory/${CategoryList.id}`"
                              class="btn btn-info btn-xs"
                              ><i class="fas fa-edit"></i
                            ></router-link>
                            <a
                              @click.prevent="categoryDelete(CategoryList.id)"
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
    this.$store.dispatch("CategoryListSaveInStore");
  },

  //  Step: 10
  computed: {
    getCategoryListFromStore() {
      
      return this.$store.getters.categoryListFromStore;
    },
  },

  methods: {
    categoryDelete(id) {

      Swal.fire({
  title: 'Are you sure?',
  text: "You want to delete this category!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
   axios.get("/categoryDelete/" + id).then((response) => {
        this.$store.dispatch("CategoryListSaveInStore");
        Swal.fire(
          'Deleted!',
          'Category deleted successfully',
          'success'
        );
     

      });
  }
})


      
    },
  },
};
</script>

<style>
.image{
  height: 70px;
  width: 100px;
}
</style>