var UITree = function () {
    return {
        //main function to initiate the module
        init: function (extra_node) {

            var DataSourceTree = function (options) {
                this._data = options.data;
                this._delay = options.delay;
            };

            DataSourceTree.prototype = {
                data: function (options, callback, active_node) {
                    this.callback = callback;
                    var self = this;
                    // 获取远程数据 // todo
                    if (extra_node!=undefined) {
                        // 自定义调用
                        extra_node.getTargetItem(active_node, function(data){
                            this.data = data;
                            var target = this;
                            setTimeout(function () {
                                var data = $.extend(true, [], target.data);
                                self.callback({ data: data });   // 加载数据回调方法
                            }, self._delay)
                        });
                    } else {
                        setTimeout(function () {
                            var data = $.extend(true, [], self._data);
                            callback({ data: data });   // 加载数据回调方法
                        }, this._delay)
                    }
                }
            };

            var treeDataSource4 = new DataSourceTree({
                data: [
                    { name: 'Projects<div class="tree-actions"><i class="fa fa-plus green"></i><i class="fa fa-trash-o danger"></i><i class="fa fa-rotate-right blizzard"></i></div>', type: 'folder', additionalParameters: { id: 'F11' } },
                    { name: 'Reports<div class="tree-actions"><i class="fa fa-plus green"></i><i class="fa fa-trash-o danger"></i><i class="fa fa-rotate-right blizzard"></i></div>', type: 'folder', additionalParameters: { id: 'F12' } },
                    { name: 'Member <div class="tree-actions"><i class="fa fa-plus green"></i><i class="fa fa-trash-o danger"></i><i class="fa fa-rotate-right blizzard"></i></div>', type: 'item', additionalParameters: { id: 'I11' } },
                    { name: 'Events <div class="tree-actions"><i class="fa fa-plus green"></i><i class="fa fa-trash-o danger"></i><i class="fa fa-rotate-right blizzard"></i></div>', type: 'item', additionalParameters: { id: 'I12' } },
                    { name: 'Portfolio <div class="tree-actions"><i class="fa fa-plus green"></i><i class="fa fa-trash-o danger"></i><i class="fa fa-rotate-right blizzard"></i></div>', type: 'item', additionalParameters: { id: 'I12' } }
                ],
                delay: 400
            });
            var tree = $('#MyTree').tree({
                selectable: false,
                dataSource: treeDataSource4,
                loadingHTML: '<div class="tree-loading"><i class="fa fa-rotate-right fa-spin"></i></div>'
            });

        }
    };
}();
