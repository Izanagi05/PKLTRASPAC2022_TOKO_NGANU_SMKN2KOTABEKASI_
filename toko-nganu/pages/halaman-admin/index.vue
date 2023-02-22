<template>
  <div>
    <div class="bar">
      <div class="contact white--text">
        <div class="contact-text font-weight-regular">+62-000-000-000</div>
      </div>
    </div>
    <div class="home-container">
      <v-row>
        <v-col cols="1">
          <div class="">
            <v-img :src="require('~/assets/logo.png')" width="100px"></v-img>
          </div>
        </v-col>
        <v-col>
          <div class="store-name f24sb">
            <div>Toko Nganu</div>
          </div>
        </v-col>
        <v-col>
          <!-- <v-text-field
            class="search"
            rounded
            placeholder="Search nganu"
            append-icon="mdi-magnify"
          ></v-text-field>           -->
        </v-col>
      </v-row>
      <div class="dialog-edit">
        <v-dialog v-model="dialog" max-width="500px">
          <v-card>
            <v-card-title>
              <span class="text-h5">Edit Barang</span>
            </v-card-title>
            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field
                      v-model="editedBarang.foto"
                      label="Foto Barang"
                    ></v-text-field
                  ></v-col>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field
                      v-model="editedBarang.nama"
                      label="Nama Barang"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field
                      v-model="editedBarang.harga"
                      label="Harga Barang"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field
                      v-model="editedBarang.stok"
                      label="Stok Barang"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field
                      v-model="editedBarang.deskripsi"
                      label="Deskripsi Barang"
                    ></v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="close"> Cancel </v-btn>
              <v-btn color="blue darken-1" text @click="save"> Save </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </div>
      <div class="content">
        <div class="kiri">
          <div class="sub-title" height="30px">Halaman Admin</div>
          <div class="produk ml-6" style="font-size: 16px">
            <span class="mdi mdi-package-variant-closed">Produk</span>
          </div>
          <div class="tambah-produk ml-6" style="font-size: 16px">
            <span class="mdi mdi-package-variant-closed-plus"
              >Tambah Produk</span
            >
          </div>
          <div class="logout ml-6 pb-4" style="font-size: 16px">
            <span class="mdi mdi-logout mdi-35px">Logout</span>
          </div>
        </div>
        <div class="pembatas mb-6"></div>
        <div class="crud">
          <div class="barang pt-5">
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
                          <div class="price-product f14sb pr-1">
                            Rp. 1.999.999
                          </div>
                        </v-col>
                      </v-row>
                      <v-row>
                        <v-col>
                          <div class="desc-product font-weight-regular pl-1">
                            Bingung masbro
                          </div>
                        </v-col>
                      </v-row>
                      <div class="btn-card pl-2 pb-3 pt-3">
                        <v-btn
                          class="rounded-xl edit-btn font-weight-regular"
                          style="
                            font-size: 12px;
                            background: #2f432d;
                            color: white;
                          "
                        >
                          Edit
                        </v-btn>
                        <v-btn
                          class="rounded-xl hapus-btn font-weight-medium pl-3"
                          outlined
                          style="font-size: 12px; color: red"
                        >
                          Hapus
                        </v-btn>
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
                          <div class="price-product f14sb pr-1">
                            Rp. 1.999.999
                          </div>
                        </v-col>
                      </v-row>
                      <v-row>
                        <v-col>
                          <div class="desc-product font-weight-regular pl-1">
                            Bingung masbro
                          </div>
                        </v-col>
                      </v-row>
                      <div class="btn-card pl-2 pb-3 pt-3">
                        <v-btn
                          class="rounded-xl edit-btn font-weight-regular"
                          style="
                            font-size: 12px;
                            background: #2f432d;
                            color: white;
                          "
                        >
                          Edit
                        </v-btn>
                        <v-btn
                          class="rounded-xl hapus-btn font-weight-medium pl-3"
                          outlined
                          style="font-size: 12px; color: red"
                        >
                          Hapus
                        </v-btn>
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
                          <div class="price-product f14sb pr-1">
                            Rp. 1.999.999
                          </div>
                        </v-col>
                      </v-row>
                      <v-row>
                        <v-col>
                          <div class="desc-product font-weight-regular pl-1">
                            Bingung masbro
                          </div>
                        </v-col>
                      </v-row>
                      <div class="btn-card pl-2 pb-3 pt-3">
                        <v-btn
                          class="rounded-xl edit-btn font-weight-regular"
                          style="
                            font-size: 12px;
                            background: #2f432d;
                            color: white;
                          "
                        >
                          Edit
                        </v-btn>
                        <v-btn
                          class="rounded-xl hapus-btn font-weight-medium pl-3"
                          outlined
                          style="font-size: 12px; color: red"
                        >
                          Hapus
                        </v-btn>
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
                          <div class="price-product f14sb pr-1">
                            Rp. 1.999.999
                          </div>
                        </v-col>
                      </v-row>
                      <v-row>
                        <v-col>
                          <div class="desc-product font-weight-regular pl-1">
                            Bingung masbro
                          </div>
                        </v-col>
                      </v-row>
                      <div class="btn-card pl-2 pb-3 pt-3">
                        <v-btn
                          class="rounded-xl edit-btn font-weight-regular"
                          style="
                            font-size: 12px;
                            background: #2f432d;
                            color: white;
                          "
                          @click.prevent="editBarang(barang)"
                        >
                          Edit
                        </v-btn>
                        <v-btn
                          class="rounded-xl hapus-btn font-weight-medium pl-3"
                          outlined
                          style="font-size: 12px; color: red"
                        >
                          Hapus
                        </v-btn>
                      </div>
                    </v-card>
                  </v-col>
                </v-row>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data: () => ({
    dialog: false,
    barang: [],
    editedIndex: -1,
    editedBarang: {
      foto: "",
      nama: "",
      harga: 0,
      stok: 0,
      deskripsi: "",
    },
  }),
  method: {
    editBarang(barang) {
      this.editedIndex = this.barang.indexOf(barang);
      this.editedBarang = Object.assign({}, barang);
      this.dialog = true;
    },
    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.barang[this.editedIndex], this.editedBarang);
      } else {
        this.barang.push(this.editedBarang);
      }
      this.close();
    },
  },
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Tambah Barang" : "Edit Barang";
    },
  },
};
</script>
<style>
.contact {
  background-color: #2f432d;
  padding: 5px 0px 7px 154px;
}
.home-container {
  padding: 0px 123px;
}
.f24sb {
  padding-top: 15px;
  font-weight: 600;
  font-size: 24px;
  line-height: 36px;
}
.content {
  display: flex;
  gap: 38px;
}
.sub-title {
  font-family: "Poppins", sans-serif;
  font-weight: 700;
  font-size: 20px;
}
.menu {
  font-family: "Poppins", sans-serif;
  font-weight: 500;
  font-size: 20px;
}
.logout {
  margin-top: 570px;
  font-family: "Poppins", sans-serif;
  font-weight: 500;
  font-size: 20px;
}
.pembatas {
  border-left: 8px solid #d9d9d9;
  border-radius: 20px;
  height: 750px;
  margin-right: 10px;
}
</style>
