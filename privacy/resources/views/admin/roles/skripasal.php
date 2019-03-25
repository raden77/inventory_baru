
<!-- <div class="form-group">
                    {{ Form::label('roles', 'Roles:') }}
                    {{ Form::select('roles[]', $roles , null, ['class'=> 'form-control','multiple']) }}
                </div> -->

                <div class="form-group">
                                    {{ Form::label('name', 'Tipe Barang:') }}
                                    {{ Form::select('tipe_barang',
                                    array('RAW MATERIAL'=>'RAW MATERIAL','FINISH GOOD'=>'FINISH GOOD'),
                                    ['class'=>'form-control']) }}
                                </div>
                                 <input id="tipe_barang" type="text" class="form-control" name="tipe_barang" value="{{ old('tipe_barang') }}" required autofocus>

                                 <select class="form-control" name="nama_barang">
                        if ($barangAll->count())
                        foreach($barangAll as $barang)
                        <option value="{{ $barang->kode_barang }}" {{ $selectedBarang == $barang->kode_barang ? 'selected="selected"' : '' }}>{{ $barang->nama_barang }}</option>    
                        endforeach
                        endif
                    </select>