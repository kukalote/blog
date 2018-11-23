@extends('goods.goods_detail', ['type'=>'modify'])
@section('goods_part')
                                        <form class="form-horizontal" id="form_goods_detail">
                                        <div class="form-group">
                                            <div class=" col-sm-6">
                                                <label for="title" class="col-sm-3 control-label text-align-left"> 商品名称: </label>
                                                <div class="col-sm-9">
                                                    <input value="{{$detail['title']}}" name="title" placeholder="商品名称" type="text" class="form-control"/>
                                                </div>
                                            </div>
                                            <div class=" col-sm-6">
                                                <label for="category_id" class="col-sm-3 control-label text-align-left"> 商品类别: </label>
                                                <div class="col-sm-9">
                                                    <select name="category_id">
                                                            <option value="0"> --请选择-- </option>
                                                        @foreach($categorys as $val)
                                                            @if ($val['id']==$detail['category_id'])
                                                            <option value="{{$val['id']}}" selected> {{$val['category']}} </option>
                                                            @else
                                                            <option value="{{$val['id']}}"> {{$val['category']}} </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class=" col-sm-6">
                                                <label for="model" class="col-sm-3 control-label text-align-left"> 商品型号: </label>
                                                <div class="col-sm-9">
                                                    <input value="{{$detail['model']}}" name="model" placeholder="商品型号" type="text" class="form-control"/>
                                                </div>
                                            </div>
                                            <div class=" col-sm-6">
                                                <label for="activity" class="col-sm-3 control-label text-align-left"> 商品活动: </label>
                                                <div class="col-sm-9">
                                                    <input value="{{$detail['activity']}}" name="activity" placeholder="商品活动(商品副标题)" type="text" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                                <div class="widget flat radius-bordered">
                                                    <div class="widget-header bordered-bottom bordered-themeprimary">
                                                        <span class="widget-caption"> 商品信息 </span>
                                                        <div class="widget-buttons">
                                                            <a href="#" data-toggle="maximize">
                                                                <i class="fa fa-expand"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="widget-body">
                                                        <div class="widget-main no-padding">
                                                            <textarea id="summernote" name="content"> {{$detail['content']}} </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-12 col-sm-12 col-xs-12 pull-right">
                                                {{ csrf_field() }}
                                                <input name="id" type="hidden" value="{{$detail['id']}}"/>
                                                <button type="submit" class="btn btn-primary btn-lg pull-right margin-right-30">提交</button>
                                            </div>
                                        </div>
                                        </form>
@endsection
