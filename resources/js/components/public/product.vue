<template>
  <div class="row bg-white" id="desk-home">
    <div class="col-lg-8 col-md-8">
      <div id="shop" class="shop grid-container clearfix row">
        <div
          class="clearfix"
          v-for="(catProduct, index) in showCatProduct"
          v-bind:key="catProduct"
        >
          <div class="clearfix" v-if="index == 0">
            <div class="cat_image">
              <img v-bind:src="catProduct.cat_image" class="img-fluid" />
              <div class="bottom-left img-txt">
                <h5>{{ catProduct.cat_name }}</h5>
              </div>
            </div>
          </div>
          <div>
            <div style="padding-top: 10px">
              <div style="border: 1px solid; width: 6%; text-align: center">
                {{ catProduct.id }}
              </div>
              {{ catProduct.product_name }}

              <button
                data-toggle="modal"
                :data-target="catProduct.has_attributes == 1 ? '#myModal' : '#address'"
                class="bg-brown btn-cart-m"
                @click.prevent="sendInfo(catProduct.id)"
              >
                <span class="plus">+</span
                ><span style="padding: 0 5px">{{ catProduct.product_price }}</span>
              </button>
              <hr />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4">
      <cart-section></cart-section>
    </div>
  </div>
</template>
