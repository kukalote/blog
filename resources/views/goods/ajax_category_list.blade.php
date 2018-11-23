                                            <table class="table table-bordered table-striped table-condensed flip-content">
                                                <thead class="flip-content bordered-palegreen">
                                                    <tr>
                                                        <th> ID </th>
                                                        <th> 商品种类 </th>
                                                        <th> 操作 </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($list->items() as $item)
                                                    <tr>
                                                        <td> {{$item->id}} </td>
                                                        <td> {{$item->category}} </td>
                                                        <td>
                                                            <a href="#" class="btn btn-info btn-xs" data-category="{{$item->category}}" data-id="{{$item->id}}" data-toggle="modal" data-target="#modifyModal">
                                                                <i class="fa fa-edit"></i> Edit
                                                            </a>
                                                            <a href="#" class="btn btn-danger btn-xs" data-id="{{$item->id}}" data-toggle="modal" data-target="#deleteModal">
                                                                <i class="fa fa-trash-o"></i> Delete
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            {{$list->render()}}
