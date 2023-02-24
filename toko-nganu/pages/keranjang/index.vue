<template>
  <div>
    <Navbar />
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
              <div class="cart-content" v-for="(user, index) in datakeranjang" :key="index">
                <div v-for="(dataa, index) in user.user_keranjang" :key="index">
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
                         masih id barang:{{dataa.barang_id}}
                        </div>
                      </v-col>
                      <v-col>
                        <div class="font-weight-medium">Rp. {{ price }}</div>
                      </v-col>
                      <v-col>
                        <div class="d-flex kuantitas">
                          <div>
                            <div v-if="dataa.kuantitas == 0">
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
                            {{ dataa.kuantitas }}
                          </div>
                          <button
                            class="pluskuantitas"
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
import axios from 'axios'
export default {
  middleware: "middlewareku",
  data() {
    return {
      price: 100000,
      pricetotal: 0,
      datakeranjang: {
        barang_id:'',
        kuantitas:'',
      },
      userid: null,

      tes: [
        { title: "tes tes tes1", kuantitas: 1 },
        { title: "tes tes tes2", kuantitas: 0 },
        { title: "tes tes tes3", kuantitas: 0 },
        { title: "tes tes tes4", kuantitas: 0 },
        { title: "tes tes tes5", kuantitas: 0 },
        { title: "tes tes tes6", kuantitas: 0 },
        { title: "tes tes tes7", kuantitas: 0 },
        { title: "tes tes tes7", kuantitas: 0 },
      ],
    };
  },
  methods: {
    getkeranjang(){
      axios.get('http://127.0.0.1:8000/api/keranjangbyuser/'+this.userid).then(respon=>{
        this.datakeranjang = respon.data
      })
    },
    countplus(dataa) {
      dataa.kuantitas++;

      this.pricetotal = parseInt(this.tes.kuantitas) * parseInt(this.price);
    },
    countmin() {
      if (this.kuantitas < 1) {
        this.kuantitas = 0;
      } else {
        this.tes.kuantitas -= 1;
      }
      console.log("pp");
    },
  },
  created() {
    const usid = this.$cookies.get('cookieku')
    this.userid = usid.data.id
    this.getkeranjang()
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
.kuantitas {
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
