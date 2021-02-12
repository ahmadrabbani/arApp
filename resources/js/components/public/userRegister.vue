<template>
  <div>
    <div class="breadcrumb-option">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcrumb__links">
              <router-link class="nav-link" :to="`/`"
                ><i class="fa fa-home"></i> Home</router-link
              >
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container topmargin">
      <div class="row">
        <div class="col-lg-12">
          <h5>Please Register</h5>
          <hr />
          <h4 v-if="success" class="text-success">{{ success }}</h4>
          <form @submit.prevent="register" method="post" class="checkout__form">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="checkout__form__input">
                  <p>First Name <span>*</span></p>
                  <input
                    v-model="form['first_name']"
                    type="text"
                    class="form-control"
                    name="first_name"
                  />
                  <span v-if="error.first_name" class="text-danger">{{
                    error.first_name[0]
                  }}</span>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="checkout__form__input">
                  <p>Last Name <span>*</span></p>
                  <input
                    v-model="form['last_name']"
                    type="text"
                    class="form-control"
                    name="last_name"
                  />
                </div>
              </div>

              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="checkout__form__input">
                  <p>Email <span>*</span></p>
                  <input
                    v-model="form['email_address']"
                    type="email"
                    class="form-control"
                    name="email_address"
                  />
                  <span v-if="error.email_address" class="text-danger">{{
                    error.email_address[0]
                  }}</span>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="checkout__form__input">
                  <p>Phone No <span>*</span></p>
                  <input
                    v-model="form['phone_no']"
                    type="text"
                    class="form-control"
                    name="phone_no"
                  />
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="checkout__form__input">
                  <p>Password <span>*</span></p>
                  <input
                    v-model="form['password']"
                    type="password"
                    class="form-control"
                    name="password"
                  />
                  <span v-if="error.password" class="text-danger">{{
                    error.password[0]
                  }}</span>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="checkout__form__input">
                  <p>Address <span>*</span></p>
                  <textarea
                    v-model="form['address']"
                    class="form-control"
                    name="address"
                  ></textarea>
                </div>
              </div>
              <div class="row">
                <button type="submit" class="site-btn">Register</button>

                <router-link to="/user-login" class="site-btn bg-green"
                  >Login Here</router-link
                >
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "userRegister",
  data() {
    return {
      form: [],
      error: [],
      success: "",
    };
  },
  mounted() {},
  methods: {
    register() {
      (this.error = []), (this.success = ""), this.$Progress.start();
      axios
        .post("user-register", {
          first_name: this.form.first_name,
          last_name: this.form.last_name,
          email_address: this.form.email_address,
          phone_no: this.form.phone_no,
          password: this.form.password,
          address: this.form.address,
        })
        .then((response) => {
          //console.log(response.data.errors)
          //this.$router.push('/user-login')
          this.success =
            "Thanks For Registration. We have email you with password.";
          this.form = [];
          this.$store.dispatch("customerSession");
          this.$Progress.finish();
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.error = error.response.data.errors;
            this.$Progress.finish();
          }
        });
    },
  },
};
</script>
