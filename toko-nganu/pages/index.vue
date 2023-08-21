<template>
  <div>
    <div class="ppp">
      <div class="contact white--text">
        <div class="contact-text font-weight-regular">
          <button class="kontak" type="submit" @click="kontak">
            <v-icon color="white">mdi-phone</v-icon>
            +62-815-6315-10389
          </button>
        </div>
      </div>
      <div class="container pb-4">
        <v-row>
          <v-col class="d-flex col-12 col-lg-6 col-md-4 col-sm-12 col-xs-12">
            <div class="logo">
              <v-img
                :src="require('~/assets/logo_nganu.png')"
                width="100"
              ></v-img>
            </div>
            <div class="nama_toko">
              <div class="">Toko nganu</div>
            </div>
          </v-col>
          <v-col
            class="d-flex col-12 col-lg-6 col-md-8 col-sm-12 col-xs-12 justify-end"
          >
            <div flat class="rounded-pill" color="#d9d9d9">
              <v-text-field
                class="nyari rounded-pill"
                v-model="cari"
                label="Cari Nganu"
                single-line
                hide-details
                outlined
                @keyup.enter="getsearchbarang()"
                append-icon="mdi-magnify"
                placehoder="cari"
              ></v-text-field>
            </div>

            <!-- <div class="profile_icon_keranjang"> -->
            <nuxt-link to="/keranjang" class="text-decoration-none ml-2">
              <v-btn elevation="2" fab color="d9d9d9" icon
                ><v-icon size="29px">mdi-cart</v-icon></v-btn
              >
            </nuxt-link>
            <nuxt-link to="/user-view" class="text-decoration-none ml-2">
              <v-btn elevation="2" fab icon color="d9d9d9">
                <v-avatar class="foto-profilan">
                  <img
                    :src="
                      'http://127.0.0.1:8000/storage/' +
                      $cookies.get(`cookieku`).data.foto_profil
                    "
                  />
                </v-avatar>
              </v-btn>
            </nuxt-link>
            <div class="display-5 my-auto ml-2 font-weight-bold text-truncate">
              {{ $cookies.get("cookieku").data.nama }}
            </div>
            <!-- </div> -->
          </v-col>
        </v-row>
      </div>
    </div>
    <div class="all-home">
      <div class="container">
        <div class="home-image">
          <v-skeleton-loader
            v-if="firstLoad"
            :loading="loading"
            type="image : ~/assets/home-img.png"
            max-width="100%"
            max-height="auto"
          ></v-skeleton-loader>
          <v-carousel
            v-else
            cycle
            height="auto"
            hide-delimiter-background
            show-arrows-on-hover
            class="object-fit-cover"
          >
            <v-carousel-item
              v-for="(item, i) in items"
              :key="i"
              :src="item.src"
            >
            </v-carousel-item>
          </v-carousel>
        </div>
        <div>
          <div v-if="firstLoad" class="d-flex mt-8">
            <v-skeleton-loader
              class="ma-2"
              :loading="loading"
              max-width="120"
              type="button"
            ></v-skeleton-loader>
            <v-skeleton-loader
              class="ma-2"
              :loading="loading"
              type="button"
            ></v-skeleton-loader>
            <v-skeleton-loader
              class="ma-2"
              :loading="loading"
              type="button"
            ></v-skeleton-loader>
          </div>

          <div v-else class="d-flex mt-8">
            <v-btn outlined @click="getallbarang()" class="ma-2">
              Semua Kategori
            </v-btn>

            <v-btn
              outlined
              v-for="(ktg, index) in allkategori"
              :key="index"
              @click="getkategori(ktg)"
              class="ma-2"
            >
              {{ ktg.nama }}
            </v-btn>
          </div>
        </div>
        <div class="recomend f24sb">
          <div v-if="firstLoad">
            <v-skeleton-loader
              :loading="loading"
              type="list-item"
            ></v-skeleton-loader>
          </div>

          <div v-else>
            <span>Rekomendasi untuk anda</span>
          </div>
        </div>
        <div>
          <div class="product-card">
            <div class="tampil1" v-if="set == 0">
              <v-row class="p-0">
                <v-col
                  cols="5"
                  class="mt-4 col-md-4 col-sm-6 col-xs-6 d-flex justify-center"
                  v-for="(brg, index) in allbarang"
                  :key="index"
                >
                  <v-card color="#ffffff" class="rounded-lg" elevation="1">
                    <v-skeleton-loader
                      v-if="firstLoad"
                      type="card"
                      width="100%"
                      height="200px"
                    ></v-skeleton-loader>
                    <div v-else>
                      <v-img
                        v-if="brg.nama"
                        :src="require(`~/assets/makanan.jpg`)"
                      ></v-img>
                      <v-skeleton-loader
                        v-else
                        type="card"
                        width="100%"
                        height="200px"
                      ></v-skeleton-loader>
                      <div class="pa-4">
                        <div
                          v-if="brg.nama"
                          class="font-weight-medium text-capitalize"
                        >
                          {{ brg.nama }}
                        </div>
                        <v-skeleton-loader
                          v-else
                          :loading="loading"
                          type="text"
                          width="70%"
                        ></v-skeleton-loader>
                        <div>
                          <div class="font-weight-medium">Rp. 2000</div>
                        </div>
                        <v-row align="center">
                          <v-col cols="auto">
                            <div
                              v-if="brg.toko?.nama"
                              class="d-flex align-center"
                            >
                              <v-img
                                :src="
                                  require('~/assets/pajamas_tanuki-verified.png')
                                "
                                max-width="16"
                              ></v-img>
                              <span class="ml-2">{{ brg.toko?.nama }}</span>
                            </div>
                            <v-skeleton-loader
                              v-else
                              :loading="loading"
                              type="circle"
                              width="20px"
                              height="20px"
                            ></v-skeleton-loader>
                            <!-- <v-skeleton-loader
                              :loading="loading"
                              type="text"
                              width="30%"
                            ></v-skeleton-loader> -->
                          </v-col>
                        </v-row>
                        <div class="btn-card mt-2 pb-1">
                          <div v-if="rating">
                            <v-icon color="orange">mdi-star</v-icon>
                            <v-icon color="orange">mdi-star</v-icon>
                            <v-icon color="orange">mdi-star</v-icon>
                            <v-icon color="orange">mdi-star</v-icon>
                            <v-icon color="orange">mdi-star</v-icon>
                            <span>I</span>
                            <span>{{ rating }}</span>
                          </div>
                          <v-skeleton-loader
                            v-else
                            :loading="loading"
                            type="text"
                            width="50px"
                          ></v-skeleton-loader>
                        </div>
                      </div>
                    </div>
                  </v-card>
                </v-col>
              </v-row>
            </div>
            <!-- <div class="tampil3" v-if="set == 2">
              <v-row class="p-0 justify-center">
                <v-col
                  class="col-6 mt-4 col-lg-3 col-md-4 col-sm-6 col-xs-6 d-flex justify-center gx-2"
                  width="204px"
                  v-for="(brg, index) in hasilcari"
                  :key="index"
                >
                  <v-card width="204px">
                    <v-img
                      :src="require('~/assets/makanan.jpg')"
                      width="204px"
                    ></v-img>
                    <v-row>
                      <v-col class="">
                        <div class="f14sb pl-1">
                          {{ brg.nama }}
                        </div>
                      </v-col>
                      <v-col>
                        <div class="f14sb pr-1">Rp. 1.999.999</div>
                      </v-col>
                    </v-row>
                    <v-row>
                      <v-col>
                        <div class="font-weight-regular pl-1">
                          <v-img
                            :src="
                              require('~/assets/pajamas_tanuki-verified.png')
                            "
                          ></v-img
                          >{{ brg.deskripsi }}
                        </div>
                      </v-col>
                    </v-row>
                    <div class="mt-2 pl-1 pb-1">
                      <button
                        class="rounded-xl view-more-btn font-weight-regular"
                        style="font-size: 12px"
                        @click="todetail(brg)"
                      >
                        Lebih lengkap
                      </button>
                    </div>
                  </v-card>
                </v-col>
              </v-row>
            </div> -->
            <!-- <div class="tampil2" v-if="set == 1">
              <v-row
                class="p-0 justify-center"
                v-for="(brg, index) in hasilKategori"
                :key="index"
              >
                <v-col
                  cols="5"
                  class="mt-4 col-lg-3 col-md-4 col-sm-6 col-xs-6 d-flex justify-center gx-2"
                  width="204px"
                  v-for="(barang, index) in brg.barang"
                  :key="index"
                >
                  <v-card>
                    <v-img :src="require('~/assets/makanan.jpg')"></v-img>
                    <v-row>
                      <v-col cols="3" class="">
                        <div class="font-weight-medium pl-1">
                          {{ barang.nama }}
                        </div>
                      </v-col>
                      <v-col>
                        <div class="font-weight-medium pr-1">Rp. 1.999.999</div>
                      </v-col>
                    </v-row>
                    <v-row>
                      <v-col>
                        <div class="font-weight-regular pl-1">
                          {{ barang.deskripsi }}
                        </div>
                      </v-col>
                    </v-row>
                    <div class="mt-2 pl-1 pb-1">
                      <button
                        class="rounded-xl view-more-btn font-weight-regular"
                        style="font-size: 12px"
                        @click="todetail2(barang)"
                      >
                        Lebih lengkap
                      </button>
                    </div>
                  </v-card>
                </v-col>
              </v-row>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  middleware: "middlewareku",
  data() {
    return {
      rating: "4.9",
      firstLoad: true,
      set: 0,
      cari: null,
      hasilcari: [],
      no_admin: "6281563151038",
      nama: null,
      tokouser: null,
      Toko: null,
      barangparam: null,
      allbarang: {
        barang_id: "",
      },
      allkategori: {
        kategori_id: "",
      },
      hasilKategori: {
        barang_id: "",
      },
      items: [
        {
          src: "home-img.png",
        },
        {
          src: "home-img.png",
        },
        {
          src: "home-img.png",
        },
      ],
    };
  },
  methods: {
    search() {
      // this.searchteks = this.$emit('emitsearch')
      console.log("ets" + this.searchteks);
    },
    kontak() {
      let nomer = this.no_admin;
      window.open("https://wa.me/" + nomer);
    },
    gettoko() {
      axios
        .get("http://127.0.0.1:8000/api/gettoko/" + this.tokouser)
        .then((respon) => {
          this.Toko = respon.data;
        });
    },
    getallbarang() {
      axios.get("http://127.0.0.1:8000/api/getallbarangtoko").then((respon) => {
        this.allbarang = respon.data;
      });
      this.set = 0;
    },
    getsearchbarang() {
      axios
        .get("http://127.0.0.1:8000/api/search/" + this.cari)
        .then((respon) => {
          this.hasilcari = respon.data;
          console.log(respon.data);
        });
      this.set = 2;
    },
    getallkategori() {
      axios.get("http://127.0.0.1:8000/api/getallkategori").then((respon) => {
        this.allkategori = respon.data;
      });
    },
    getkategori(ktg) {
      axios
        .get(`http://127.0.0.1:8000/api/getkategori/${ktg.kategori_id}`)
        .then((respon) => {
          console.log(respon.data);
          this.hasilKategori = respon.data;
        });
      this.set = 1;
    },
    todetail(brg) {
      // console.log(brg.barang_id)
      this.$router.push(`/detail/${brg.barang_id}`);
    },
    todetail2(barang) {
      // console.log(brg.barang_id)
      this.$router.push(`/detail/${barang.barang_id}`);
    },
  },

  created() {
    const userid = this.$cookies.get("cookieku");
    this.nama = userid.data.nama;
    console.log(userid);
    this.tokouser = userid.data.id;
    this.gettoko();
    this.getallkategori();
    this.getsearchbarang();
    this.getallbarang();
  },
  mounted() {
    // Simulate loading delay
    setTimeout(() => {
      this.firstLoad = false;
      this.loading = false;
    }, 3000);
  },
};
</script>
<style>
.col-5 {
  flex: 0 0 20%;
  max-width: 20%;
}

.ppp {
  /* margin-bottom: 51px; */
  font-family: "Poppins", sans-serif;
}

.contact {
  background: #2f432d;
  padding: 9px 123px 10px 123px;
}

.home-container {
  padding: 0px 123px;
}

.ppp {
  overflow: hidden;
  margin-bottom: 51px;
  font-family: "Poppins", sans-serif;
}

.nav {
  padding: 39px 123px 10px 123px;
  display: flex;
}
</style>