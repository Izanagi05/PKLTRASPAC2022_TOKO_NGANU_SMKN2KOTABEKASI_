<template>
  <div>
    <div class="home">
      <Navbar />

        <div class="home-image">
          <v-img :src="require('~/assets/home-img.png')"></v-img>
        </div>

        <div class="filter">
          <v-btn>
            Filter
            <v-icon>mdi-filter</v-icon>
          </v-btn>
        </div>

        <div class="recomend f24sb">Rekomendasi untuk anda</div>

        <div>
          <div class="product-card">
            <v-row class="p-0">
              <v-col class="card-col p-0" width="204px">
                <v-card width="204px">
                  <v-img
                    :src="require('~/assets/barang.png')"
                    width="204px"
                  ></v-img>
                  <v-row>
                    <v-col cols="5" class="">
                      <div class="title-product f14sb pl-1">Mas bro</div>
                    </v-col>
                    <v-col>
                      <div class="price-product f14sb pr-1">Rp. 1.999.999</div>
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col>
                      <div class="desc-product font-weight-regular pl-1">
                        Bingung masbro
                      </div>
                    </v-col>
                  </v-row>
                  <div class="btn-card pl-1 pb-1">
                    <button
                      class="rounded-xl view-more-btn font-weight-regular"
                      style="font-size: 12px"
                    >
                      Lebih lengkap
                    </button>
                  </div>
                </v-card>
              </v-col>
              <v-col class="card-col p-0">
                <v-card width="204px">
                  <v-img
                    :src="require('~/assets/barang.png')"
                    width="204px"
                  ></v-img>
                  <v-row>
                    <v-col cols="5" class="">
                      <div class="title-product f14sb pl-1">Mas bro</div>
                    </v-col>
                    <v-col>
                      <div class="price-product f14sb pr-1">Rp. 1.999.999</div>
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col>
                      <div class="desc-product font-weight-regular pl-1">
                        Bingung masbro
                      </div>
                    </v-col>
                  </v-row>
                  <div class="btn-card pl-1 pb-1">
                    <button
                      class="rounded-xl view-more-btn font-weight-regular"
                      style="font-size: 12px"
                    >
                      Lebih lengkap
                    </button>
                  </div>
                </v-card>
              </v-col>
              <v-col class="card-col p-0">
                <v-card width="204px">
                  <v-img
                    :src="require('~/assets/barang.png')"
                    width="204px"
                  ></v-img>
                  <v-row>
                    <v-col cols="5" class="">
                      <div class="title-product f14sb pl-1">Mas bro</div>
                    </v-col>
                    <v-col>
                      <div class="price-product f14sb pr-1">Rp. 1.999.999</div>
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col>
                      <div class="desc-product font-weight-regular pl-1">
                        Bingung masbro
                      </div>
                    </v-col>
                  </v-row>
                  <div class="btn-card pl-1 pb-1">
                    <button
                      class="rounded-xl view-more-btn font-weight-regular"
                      style="font-size: 12px"
                    >
                      Lebih lengkap
                    </button>
                  </div>
                </v-card>
              </v-col>
              <v-col class="card-col p-0">
                <v-card width="204px">
                  <v-img
                    :src="require('~/assets/barang.png')"
                    width="204px"
                  ></v-img>
                  <v-row>
                    <v-col cols="5" class="">
                      <div class="title-product f14sb pl-1">Mas bro</div>
                    </v-col>
                    <v-col>
                      <div class="price-product f14sb pr-1">Rp. 1.999.999</div>
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col>
                      <div class="desc-product font-weight-regular pl-1">
                        Bingung masbro
                      </div>
                    </v-col>
                  </v-row>
                  <div class="btn-card pl-1 pb-1">
                    <button
                      class="rounded-xl view-more-btn font-weight-regular"
                      style="font-size: 12px"
                    >
                      Lebih lengkap
                    </button>
                  </div>
                </v-card>
              </v-col>
            </v-row>
          </div>
          <div>
            <div class="text-center view-more">
              <v-btn class="rounded-xl view-more-btn2 f16sb" outlined
                >Lihat Lainnya</v-btn
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style >
* {
  padding: 0px;
  margin: 0px;
}
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

/* .store-name{

} */
.home {
  padding-bottom: 66px;
}
.contact {
  background: #2f432d;
  padding: 9px 0px 10px 154px;
}
.contact-text {
  font-size: 16px;
  line-height: 24px;
}
.home-container {
  padding: 0px 123px;
}
.search {
  background: #d9d9d9;
  border-radius: 100px;
}
.filter .v-btn {
  margin-top: 34px;
  border-radius: 25px;
}
.recomend {
  /* font-size: 24px;
  font-weight: 600; */
  margin-top: 13px;
}
.card-col {
  margin-top: 15px;
}
.title-product {
  /* padding-left: 3px; */
}
.price-product {
  /* padding-right: 4px; */
}
.desc-product {
  font-size: 10px;
}
.view-more-btn {
  height: 30px;
  width: 114px;
  border: 1px black solid;
}
.view-more-btn:hover {
  background: #2f432d;
  color: white;
}

.view-more-btn2 {
  margin-top: 54px;
}
.home_image {
  width: 43px;
}
</style>
<script>
export default {};
</script>
