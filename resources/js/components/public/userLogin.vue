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
        <div class="offset-md-3 col-lg-6 col-md-6">
          <h3>Please Login</h3>
          <hr />
          <h5 v-if="success" class="text-success">{{ success }}</h5>
          <form @submit.prevent="login" method="post">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12">
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
              <div class="col-lg-12 col-md-12 col-sm-12">
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
              </div>

              
              <br />
              <div class="row topmaring">
                <button type="submit" class="site-btn">Login</button>

                <router-link to="/user-register" class="site-btn bg-green"
                  >Register</router-link
                >
              </div>
            
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: [],
      error: "",
      success: "",
    };
  },
  methods: {
    login() {
      (this.success = ""),
        (this.error = ""),
        axios
          .post("user-login", {
            email_address: this.form.email_address,
            password: this.form.password,
          })
          .then((response) => {
            if (response.data == "Error") {
              this.error = "Invalid Credential";
            } else {
              //console.log(response)
              this.success = "Login Success";
              this.form = [];
              this.$store.dispatch("customerSession");
              this.$router.go(-1);
            }
          });
    },
  },
};
</script>
