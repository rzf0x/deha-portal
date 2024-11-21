<div class="">
    <div class="row">
        <div class="pe-3 col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h4>Pembayaran</h4>
                </div>
                <form class="card-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Nama</label>
                        <input type="text" name="" id="" class="form-control" placeholder="" />
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="" class="form-label">Tipe Pembayaran</label>
                            <select class="form-control" name="" id="">
                                <option value="cash">Cash</option>
                                <option value="qris">QRIS</option>
                                <option value="transfer">Transfer</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Amount</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text" class="form-control" id="subtotal" value="12">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Kembalian</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text" class="form-control" id="subtotal" value="140.760">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Catatan *optional</label>
                        <div class="input-group">
                            <textarea class="form-control" name="" id="" cols="30" rows="4"></textarea>
                        </div>
                    </div>

                    <div class="d-flex mt-4 flex-sm-row flex-column justify-content-between">
                        <div class="d-flex justify-content-between justify-content-sm-none  gap-3">
                            <button class="btn btn-primary">Kalkulasi pembayaran</button>
                            <button class="btn btn-danger">Batal</button>
                        </div>
                        <button disabled class="btn mt-sm-0 mt-3 btn-secondary">Bayar sekarang</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h4>Transaksi Produk</h4>
                </div>
                <div class="card-body">
                    <div class="product-item d-flex ">
                        <img src="/api/placeholder/80/80" alt="Product Image" class="rounded bg-secondary">
                        <div class="d-flex w-100 flex-sm-row flex-column justify-content-sm-between gap-2">
                            <div class="product-details">
                                <h5 class="mb-1">Product Name 2</h5>
                                <p class="text-muted mb-0">Category: Makanan Ringan</p>
                                <p class="text-muted mb-0">Quantity: 1</p>
                            </div>
                            <div class="product-price">
                                <strong>Rp 150,000</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Detail Pembayaran</h4>
                    <div class="d-flex mt-3 flex-column">
                        <div class="mb-2 d-flex justify-content-between">
                            <h6 class="">No. Pembayaran</h6>
                            <p class="m-0">PYM-001</p>
                        </div>
                        <div class="mb-2 d-flex justify-content-between">
                            <h6 class="">No. Transaksi</h6>
                            <p class="m-0">TRX-001</p>
                        </div>
                        <div class="mb-2 d-flex justify-content-between">
                            <h6 class="">Jumlah Produk</h6>
                            <p class="m-0">3</p>
                        </div>
                        <div class="mb-2 d-flex justify-content-between">
                            <h6 class="">Pajak (10%)</h6>
                            <p class="m-0">Rp. 4.000</p>
                        </div>
                        <div class="mb-2 d-flex justify-content-between">
                            <h6 class="">Total</h6>
                            <p class="m-0">Rp. 40.000

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
