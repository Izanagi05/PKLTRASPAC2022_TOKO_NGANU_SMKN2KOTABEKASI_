<template>
  <div>
    <Navbar />
    <div class="navigasi ml-6">
      Home<span class="mdi mdi-chevron-right">Detail Barang</span>
    </div>
    <div class="content">
      <v-row>
        <v-col>
          <div class="foto-produk pt-4 pb-4" style="margin-left: 35px">
            <v-img :src="require('~/assets/barang.png')" width="479px"></v-img>
          </div>
        </v-col>
        <v-col>
          <div class="detail pt-4">
            <div class="nama-barang font-weight-bold" style="font-size: 30px">
              Masbro
            </div>
            <div class="harga font-weight-bold pt-3" style="font-size: 40px">
              Rp. 1.999.999
            </div>
            <div
              class="deskripsi font-weight-regular pt-3"
              style="font-size: 20px"
            >
              Bingung Masbro
            </div>
          </div>
          <div class="button pb-4" style="padding-top: 200px">
            <v-row>
              <v-col cols="4">
                <div class="tambah-troli pl-6">
                  <v-btn class="rounded-pill" x-large outlined
                    >Tambah <span class="mdi mdi-cart-outline"></span
                  ></v-btn>
                </div>
              </v-col>
              <v-col cols="6">
                <div class="beli-sekarang">
                  <v-btn
                    class="rounded-pill"
                    width="287px"
                    x-large
                    outlined
                    style="background: #2f432d; color: white; size: 105px"
                    >Beli Sekarang</v-btn
                  >
                </div>
              </v-col>
            </v-row>
          </div>
        </v-col>
      </v-row>
      <div class="rekomendasi pb-6 item-center" style="margin-left: 35px">
        <div class="recomend f24sb pt-5">Barang yang mungkin kamu suka</div>
        <div>
          <div class="product-card pt-4">
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
        </div>
      </div>
    </div>
  </div>
</template>
