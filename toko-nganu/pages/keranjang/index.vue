<template>
  <div>
    <div>
      <div class="cart">
        <v-row>
          <v-col class="">
            <v-row>
              <v-col>
                <div class="f14sb head-title">Produk</div>
              </v-col>
              <v-col>
                <div class="f14sb head-title">Harga</div>
              </v-col>
              <v-col>
                <div class="f14sb head-title">Jumlah</div>
              </v-col>
              <v-col>
                <div class="f14sb head-title">Total</div>
              </v-col>
            </v-row>
            <v-row>
              <div class="cart-content">
                <div v-for="(dataa, index) in tes" :key="index">
                  <v-row>
                    <div class="cart-card d-flex">
                      <v-col>
                        <v-img
                          :src="require('~/assets/barang.png')"
                          width="143px"
                        ></v-img>
                      </v-col>
                      <v-col>
                        <div class="font-weight-medium">
                          {{ dataa.title }}
                        </div>
                      </v-col>
                      <v-col>
                        <div class="font-weight-medium">Rp. {{ price }}</div>
                      </v-col>
                      <v-col>
                        <div class="d-flex quantity">
                          <div>
                            <div v-if="dataa.quantity == 0">
                              <button @click="countmin" disabled type="submit">
                                <v-icon color="AAAAAA">mdi-minus</v-icon>
                              </button>
                            </div>
                            <div v-else>
                              <button @click="countmin" type="submit">
                                <v-icon color="black">mdi-minus</v-icon>
                              </button>
                            </div>
                          </div>

                          <div class="font-weight-medium">
                            {{ dataa.quantity }}
                          </div>
                          <button
                            class="plusquantity"
                            @click="countplus(dataa)"
                            type="submit"
                          >
                            <v-icon color="black">mdi-plus</v-icon>
                          </button>
                        </div>
                      </v-col>
                      <v-col>
                        <div class="font-weight-medium">Rp. 10.000.000</div>
                      </v-col>
                    </div>
                  </v-row>
                </div>
              </div>
            </v-row>
          </v-col>

          <v-col class="">
            <div class="total-detail">
              <div class="rincian-title">Rincian Order</div>
              <v-row>
                <v-col>
                  <div>
                    <div class="line"></div>
                    Jumlah
                  </div>
                </v-col>
                <v-col class="f14sb"> x40 </v-col>
              </v-row>
              <v-row>
                <v-col> Harga </v-col>
                <v-col class="f14sb"> Rp. {{ price }} </v-col>
              </v-row>
              <v-row>
                <v-col>
                  <div class="line"></div>
                  Total Harga
                </v-col>
                <v-col class="f14sb"> Rp. {{ pricetotal }} </v-col>
              </v-row>
              <div class="f24sb">
                <Nuxt-link
                  class="checkout-btn text-decoration-none white--text"
                  to="/"
                  type="submit"
                  >Checkout</Nuxt-link
                >
              </div>
            </div>
          </v-col>
        </v-row>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  middleware: 'middlewareku',
  data() {
    return {
      price: 100000,
      pricetotal: 0,

      tes: [
        { title: "tes tes tes1", quantity: 1 },
        { title: "tes tes tes2", quantity: 0 },
        { title: "tes tes tes3", quantity: 0 },
        { title: "tes tes tes4", quantity: 0 },
        { title: "tes tes tes5", quantity: 0 },
        { title: "tes tes tes6", quantity: 0 },
        { title: "tes tes tes7", quantity: 0 },
        { title: "tes tes tes7", quantity: 0 },
      ],
    };
  },
  methods: {
    countplus(dataa) {
      dataa.quantity++;


      this.pricetotal = parseInt(this.tes.quantity) * parseInt(this.price);
    },
    countmin() {
      if (this.quantity < 1) {
        this.quantity = 0;
      } else {
        this.tes.quantity -= 1;
      }
      console.log("pp");
    },
  },
};
</script>
<style>
.f24sb {
  font-weight: 600;
  font-size: 24px;
  line-height: 36px;
}
.f20sb {
  font-weight: 600;
  font-size: 20px;
  line-height: 36px;
}
.f16sb {
  font-weight: 600;
  font-size: 16px;
  line-height: 24px;
}
.f14sb {
  font-weight: 600;
  font-size: 14px;
  line-height: 21px;
}
.f16m {
  font-weight: 500;
  font-size: 16px;
  line-height: 24px;
}
.f16r {
  font-weight: 400;
  font-size: 16px;
  line-height: 24px;
}
.f10r {
  font-weight: 400;
  font-size: 10px;
  line-height: 15px;
}

.line {
  width: 287px;
  height: 1px;
  background: black;
}
.cart {
  padding-left: 123px;
  padding-bottom: 35px;
}
.cart-content {
  padding-right: 52px;
  height: 764px;
}
.head-title {
  color: #7a7a7a;
}
.quantity {
  background: #d9d9d9;
  border-radius: 15px;
}

.total-detail {
  background: #d9d9d9;
  padding: 18px 40px 20px 40px;
  border-radius: 50px;
  width: 367px;
}
.rincian-title {
  font-weight: 600;
  font-size: 20px;
  line-height: 30px;
}
.checkout-btn {
  padding: 6px 83px;
  background: #2f432d;
  color: white;
  border-radius: 50px;
}
</style>
