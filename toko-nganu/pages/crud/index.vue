<template>
  <div>
    <Navbar />
    <div class="crud-container">
      <v-row class="judul">
        <v-col cols="12" md="6"> Tambah Produk</v-col>
      </v-row>

      <v-row dense justify="center">
        <v-col cols="12" sm="3"
          ><div class="list">Nama Barang</div>
          <div class="list">Harga</div>
          <div class="list">Stok</div>
          <div class="list">Deskripsi</div></v-col
        >
        <v-col cols="12" sm="6">
          <v-text-field
            label="Nama Barang"
            placeholder="Masukan Nama Barang"
            solo
          ></v-text-field
          ><v-text-field
            label="Harga"
            placeholder="Masukan Harga"
            solo
          ></v-text-field
          ><v-text-field
            label="Stok"
            placeholder="Masukan Jumlah Stok"
            solo
          ></v-text-field>
          <v-textarea
            solo
            name="input-7-4"
            label="Deskripsi Barang"
          ></v-textarea
        ></v-col>
        <v-col cols="12" sm="3"
          ><div class="gambar-produk">
            <v-img
              dense
              justify="center"
              contain
              max-height="200"
              max-width="200"
              :src="require('~/assets/barang.png')"
            ></v-img>
          </div>
          <v-btn
            rounded
            outlined
            class="edit-image"
            width="200px"
            height="40px"
          >
            Tambah Foto
          </v-btn></v-col
        >
      </v-row>
      <v-row class="judul" justify="end">
        <v-col cols="12" md="2"
          ><Nuxtlink to="/"
            ><v-btn rounded outlined width="150px" class="button-aksi"
              >Batal</v-btn
            ></Nuxtlink
          ></v-col
        ><v-col cols="12" md="2"
          ><v-btn outlined rounded width="150px" class="button-aksi-jual"
            >Jual</v-btn
          ></v-col
        >
      </v-row>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
.crud-container {
  padding: 0px 281px;
}
.judul {
  font-family: Poppins;
  font-weight: 600;
  font-size: 40px;
  gap: 20px;
  margin-right: 20px;
}
.list {
  margin-bottom: 50px;
  font-family: Poppins;
  font-weight: 400;
  font-size: 20px;
}
.edit-image {
  margin-top: 20px;
  margin-left: 20px;
  height: 30px;
  width: 114px;
}
.edit-image:hover {
  background: #2f432d;
  color: rgb(255, 255, 255);
}
.button-aksi-jual {
  color: rgb(255, 255, 255) !important;
  background-color: #2f432d;
}
.button-aksi-jual:hover {
  background-color: #ffffff;
  color: rgb(0, 0, 0);
}
.gambar-produk {
  width: 200px;
  height: 200px;
  margin-left: 20px;
}
.button-aksi:hover {
  background: #2f432d;
  color: white;
}
</style>