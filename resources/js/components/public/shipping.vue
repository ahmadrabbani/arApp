<template>
  <div>
    <div class="container-fluid bg-white">
      <div class="col-lg-12 checkout__form">
        <h5>Give your shipping info!</h5>
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-3">
            <button type="button" @click.prevent="clearDefault" class="btn btn-danger">
              Clear form
            </button>
          </div>
        </div>
        <form class="ant-form ant-form-horizontal order-form" @submit.prevent="shippingInfo">
          <hr />
          <div class="ant-row ant-form-item">
            <div class="ant-col ant-col-24 ant-form-item-control-wrapper">
              <div class="ant-form-item-control">
                <span class="ant-form-item-children"
                  ><input
                    placeholder="Vorname"
                    autocomplete="chrome-off"
                    type="text"
                    id="first_name"
                    v-model="first_name"
                    class="form form-control margin-checkout"
                    value=""
                /></span>
              </div>
            </div>
          </div>
          <div class="ant-row ant-form-item">
            <div class="ant-col ant-col-24 ant-form-item-control-wrapper">
              <div class="ant-form-item-control">
                <span class="ant-form-item-children"
                  ><input
                    placeholder="Nachname"
                    autocomplete="chrome-off"
                    type="text"
                    id="last_name"
                    v-model="last_name"
                    class="form form-control margin-checkout"
                    value=""
                /></span>
              </div>
            </div>
          </div>
          <div class="ant-row ant-form-item">
            <div class="ant-col ant-col-24 ant-form-item-control-wrapper">
              <div class="ant-form-item-control">
                <span class="ant-form-item-children"
                  ><input
                    placeholder="Firma (optional)"
                    autocomplete="chrome-off"
                    type="text"
                    id="company"
                    v-model="company"
                    class="form form-control margin-checkout"
                    value=""
                /></span>
              </div>
            </div>
          </div>
          <div class="ant-row ant-form-item">
            <div class="ant-col ant-col-24 ant-form-item-control-wrapper">
              <div class="ant-form-item-control">
                <span class="ant-form-item-children"
                  ><input
                    placeholder="Straße"
                    autocomplete="chrome-off"
                    type="text"
                    id="street"
                    v-model="street"
                    class="form form-control margin-checkout"
                    value=""
                /></span>
              </div>
            </div>
          </div>
          <div class="ant-row ant-form-item">
            <div class="ant-col ant-col-24 ant-form-item-control-wrapper">
              <div class="ant-form-item-control">
                <span class="ant-form-item-children"
                  ><input
                    placeholder="Nr."
                    autocomplete="chrome-off"
                    type="text"
                    id="street_no"
                    v-model="address"
                    class="form form-control margin-checkout"
                    value=""
                /></span>
              </div>
            </div>
          </div>
          <div class="ant-row ant-form-item">
            <div class="ant-col ant-col-24 ant-form-item-control-wrapper">
              <div class="ant-form-item-control">
                <span class="ant-form-item-children"
                  ><input
                    placeholder="PLZ/Stadt"
                    autocomplete="chrome-off"
                    type="text"
                    id="zip"
                    v-model="postalcode"
                    class="form form-control margin-checkout"
                    value=""
                /></span>
              </div>
            </div>
          </div>
          <div class="ant-row ant-form-item">
            <div class="ant-col ant-col-24 ant-form-item-control-wrapper">
              <div class="ant-form-item-control">
                <span class="ant-form-item-children"
                  ><input
                    placeholder="Stadt"
                    autocomplete="chrome-off"
                    type="text"
                    id="city"
                    v-model="city"
                    class="form form-control margin-checkout"
                    value=""
                /></span>
              </div>
            </div>
          </div>
          <div class="ant-row ant-form-item">
            <div class="ant-col ant-col-24 ant-form-item-control-wrapper">
              <div class="ant-form-item-control">
                <span class="ant-form-item-children"
                  ><input
                    placeholder="E-Mail"
                    autocomplete="chrome-off"
                    type="text"
                    id="email"
                    v-model="email"
                    class="form form-control margin-checkout"
                    value=""
                /></span>
              </div>
            </div>
          </div>
          <div class="ant-row ant-form-item">
            <div class="ant-col ant-col-24 ant-form-item-control-wrapper">
              <div class="ant-form-item-control">
                <span class="ant-form-item-children"
                  ><input
                    placeholder="Telefon"
                    type="text"
                    id="phone"
                    v-model="phone_no"
                    class="form form-control margin-checkout"
                    value=""
                /></span>
              </div>
            </div>
          </div>
          <div class="ant-row ant-form-item">
            <div class="ant-col ant-col-24 ant-form-item-control-wrapper">
              <div class="ant-form-item-control">
                <span class="ant-form-item-children">
                  <textarea
                    maxlength="255"
                    placeholder="Zusätzliche Hinweise (optional)"
                    id="message"
                    v-model="comment"
                    class="form form-control margin-checkout"
                    style="height: 73px; min-height: 73px; max-height: 9.0072e15px"
                  ></textarea>
                </span>
              </div>
            </div>
          </div>

          <input  type="submit" class="btn btn-block btn-success" value="Zurück">
            
          
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      first_name: "",
      last_name: "",
      address: "",
      postalcode: "",
      address: "",
      company: "",
      city: "",
      email: "",
      phone_no: "",

      comment: "",
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
  computed: {
    showSession() {
      return this.$store.getters.getSessionData;
    },
  },
  methods: {
    getDefault() {
      this.full_name = this.showSession.first_name + " " + this.showSession.last_name;
      this.email = this.showSession.email_address;
      this.number = this.showSession.phone_no;
      this.address = this.showSession.address;
    },
    clearDefault() {
      (this.full_name = ""), (this.email = ""), (this.number = ""), (this.address = "");
    },
    shippingInfo() {
      axios
        .post("/shipping-info", {
          first_name: this.first_name,
          last_name: this.last_name,
          street: this.street,
          postalcode: this.postalcode,
          address: this.address,
          company: this.company,
          city: this.city,
          email: this.email,
          phone_no: this.phone_no,
          comment: this.comment,
        })
        .then((response) => {
          this.$router.push("/payment");
        });
    },
  },
};
</script>
