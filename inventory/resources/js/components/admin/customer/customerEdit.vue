

<template>
  <div>
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-md-8 mt-2">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title mt-1">Customer Update</h3>
              </div>
              <form
                role="form"
                @submit.prevent="customerUpdate"
                enctype="multipart/form-data"
              >
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputName">Customer Name </label>
                        <input type="text" v-model="customer_name" id="customer_name" name="customer_name"  class="form-control"  />
                        <div class="containError" v-if="errors && errors.customer_name" >
                          {{ errors.customer_name[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputName">Customer Phone</label>
                        <input type="text" v-model="customer_phone" id="customer_phone" name="customer_phone"  class="form-control" />
                        <div class="containError" v-if="errors && errors.customer_phone" >
                          {{ errors.customer_phone[0] }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputName">Customer Shop Name</label>
                        <input type="text" v-model="customer_shop_name" id="customer_shop_name" name="customer_shop_name"  class="form-control"  />
                        <div class="containError" v-if="errors && errors.customer_shop_name" >
                          {{ errors.customer_shop_name[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputName">Customer Address</label>
                        <input type="text" v-model="customer_address" id="customer_address" name="customer_address"  class="form-control" />
                        <div class="containError" v-if="errors && errors.customer_address" >
                          {{ errors.customer_address[0] }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputName">Customer Bank Name</label>
                        <input type="text" v-model="customer_bank_name" id="customer_bank_name" name="customer_bank_name"  class="form-control"  />
                        <div class="containError" v-if="errors && errors.customer_bank_name" >
                          {{ errors.customer_bank_name[0] }}
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputName">Customer Account Number</label>
                        <input type="text" v-model="customer_account_number" id="customer_account_number" name="customer_account_number"  class="form-control" />
                        <div class="containError" v-if="errors && errors.customer_account_number" >
                          {{ errors.customer_account_number[0] }}
                        </div>
                      </div>
                    </div>
                  </div>

            
                  <div class="form-group">
                    <label for="inputProjectLeader">Customer Image</label>
                    <input type="file" id="customer_image"  name="customer_image"  @change="getImg" class="form-control" />
                    <div class="containError" v-if="errors && errors.customer_image" >
                      {{ errors.customer_image[0] }}
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

   created() {
    axios.get("/customerById/" + this.$route.params.customerId).then((response) => {
        this.customer_name = response.data.customeryById.customer_name;
        this.customer_phone =response.data.customeryById.customer_phone;
        this.customer_shop_name = response.data.customeryById.customer_shop_name;
        this.customer_address = response.data.customeryById.customer_address;
        this.customer_bank_name = response.data.customeryById.customer_bank_name;
        this.customer_account_number = response.data.customeryById.customer_account_number;

      });
  },

  data() {
    return {
      customer_name: "",
      customer_phone: "",
      customer_shop_name: "",
      customer_address: "",
      customer_bank_name: "",
      customer_account_number: "",
      customer_image: "",
      errors: {},
    };
  },

  methods: {
    getImg(e) {
      this.customer_image = e.target.files[0];
      if (this.customer_image.size > 2097152) {
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


    
    customerUpdate() {
      let form = new FormData();
      form.append("customer_name", this.customer_name);
      form.append("customer_phone", this.customer_phone);
      form.append("customer_shop_name", this.customer_shop_name);
      form.append("customer_address", this.customer_address);
      form.append("customer_bank_name", this.customer_bank_name);
      form.append("customer_account_number", this.customer_account_number);
      form.append("customer_image", this.customer_image);

      axios.post(`/customerUpdate/${this.$route.params.customerId}`, form).then((response) => {
          this.$router.push("/customerList");
          Toast.fire({
            icon: "success",
            title: "Customer Updated successfully",
          });
          
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },

    goBack() {
      this.$router.push("/customerList");
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