<template>
  <div>
    <Navbar />
    <div class="navigasi" style="margin-left: 45px">
      Home<span class="mdi mdi-chevron-right">Detail Barang</span
      ><span class="mdi mdi-chevron-right font-weight-semi-bold"
        >Transaksi</span
      >
    </div>
    <div class="content">
      <v-row>
        <v-col cols="5">
          <div class="foto-barang pt-6 pb-6" style="margin-left: 43px">
            <v-img :src="require('~/assets/barang.png')" width="479px"></v-img>
          </div>
          <div class="carousel"></div>
        </v-col>
        <v-col cols="1">
          <div class="pembatas mb-6"></div>
        </v-col>
        <v-col cols="4">
          <div class="judul font-weight-bold pd-6" style="font-size: 32px">
            Rincian Pembayaran
          </div>
          <div
            class="sub-judul font-weight-bold pt-6 pb-4"
            style="font-size: 20px"
          >
            Opsi Pengiriman
          </div>
          <v-row>
            <v-col>
              <div class="keterangan font-weight-medium pb-4">Regular</div>
            </v-col>
            <v-col>
              <div class="ongkir">
                Rp. 9000
                <span class="mdi mdi-chevron-right"></span>
              </div>
            </v-col>
          </v-row>
          <div class="pembatas1 pb-4"></div>
          <div class="harga-jml">
            <v-row>
              <v-col>
                <div class="harga font-weight-medium pt-3 pb-4">Harga:</div>
              </v-col>
              <v-col>
                <div class="harga-barang font-weight-medium pt-3 pb-4">
                  Rp. 1.999.999
                </div>
              </v-col>
            </v-row>
            <v-row>
              <v-col>
                <div class="jumlah-barang font-weight-medium pb-4">
                  Jumlah Barang:
                </div>
              </v-col>
              <v-col>
                <div class="quantity font-weight-medium pb-4">
                  <v-row>
                    <v-col>
                      <v-icon color="black">mdi-minus</v-icon>
                    </v-col>
                    <v-col>
                      <div class="font-weight-medium">10</div>
                    </v-col>
                    <v-col>
                      <v-icon color="black">mdi-plus</v-icon>
                    </v-col>
                  </v-row>
                </div>
              </v-col>
            </v-row>
          </div>
          <div class="pembatas2 pb-4"></div>
          <div
            class="metode-bayar pt-4 font-weight-bold"
            style="font-size: 20px"
          >
            Metode Pembayaran
          </div>
          <div class="metode">
            <v-select
              :items="items"
              label="Pilih Metode Pembayaran"
              density="comfortable"
            ></v-select>
          </div>
          <div class="total-bayar pt-6">
            <v-row>
              <v-col>
                <div
                  class="teks-total font-weight-bold"
                  style="font-size: 20px"
                >
                  Total Pembayaran
                </div>
              </v-col>
              <v-col>
                <div class="harga-bayar">Rp.19.999.990</div>
              </v-col>
            </v-row>
          </div>
          <div class="button pb-6" style="padding-top: 200px">
            <v-row>
              <v-col cols="4">
                <div class="batal">
                  <v-btn class="rounded-pill" x-large outlined>Batal</v-btn>
                </div>
              </v-col>
              <v-col cols="6">
                <div class="bayar">
                  <v-btn
                    class="rounded-pill"
                    width="307px"
                    x-large
                    outlined
                    style="background: #2f432d; color: white; size: 105px"
                    >Bayar</v-btn
                  >
                </div>
              </v-col>
            </v-row>
          </div>
        </v-col>
      </v-row>
    </div>
  </div>
</template>
<script>
export default {
  data: () => ({
    items: [
      "Bayar Di Tempat",
      "Bank Virtual Akun",
      "Dana",
      "Kartu Kredit/Debit",
    ],
  }),
};
</script>
<style scoped>
.pembatas {
  border-left: 5px solid #000;
  height: 750px;
}
.pembatas1 {
  border-bottom: 2px solid #000;
}
.pembatas2 {
  border-bottom: 2px solid #000;
}
</style>
