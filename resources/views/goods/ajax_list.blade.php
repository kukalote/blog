                                            <table class="table table-bordered table-striped table-condensed flip-content">
                                                <thead class="flip-content bordered-palegreen">
                                                    <tr>
                                                        <th> ID </th>
                                                        <th> 商品名称 </th>
                                                        <th> 商品类型 </th>
                                                        <th> 商品价格 </th>
                                                        <th> 作者 </th>
                                                        <th> 操作 </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($list->items() as $item)
                                                    <tr>
                                                        <td> {{$item->id}} </td>
                                                        <td> {{$item->title}} </td>
                                                        <td> {{$categorys[$item->category_id]['category']}} </td>
                                                        <td> {{$item->price}} </td>
                                                        <td> {{$view_data->_manager_list[$item->author_id]['nick_name']}} </td>
                                                        <td>
                                                            <a href="{{url('/goods/modifypage?id='.$item->id)}}" class="btn btn-info btn-xs edit" target="_blank">
                                                                <i class="fa fa-edit"></i> Edit
                                                            </a>
                                                            <a href="#" class="btn btn-danger btn-xs delete" data-id="{{$item->id}}" data-toggle="modal" data-target="#deleteModal">
                                                                <i class="fa fa-trash-o"></i> Delete
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            {{$list->render()}}
