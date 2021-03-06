<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view("header") ?>
<?php $this->load->view("sidebar") ?>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h3>
            文章列表.
            <?php echo anchor('about/create', '新建页面', array('title'=>'新建页面','class'=>"btn btn-primary btn-xs",'role'=>"button")); ?>
        </h3>
        <form method="get">
            <div name="options" style="margin: 3px;float: left;">
                <div class="dropdown">
                    <button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                        选中项
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-xs" role="menu" aria-labelledby="dropdownMenu1">
                        <li role="presentation"><a role="del" tabindex="-1" href="javascript:void(0)" id="delSelected">删除</a></li>
                    </ul>
                </div>
            </div>
        </form>
        <table class="table table-condensed">
            <thead>
            <tr>
                <th><input type="checkbox" name="checkAll" id="checkAll"/></th>
                <th>#</th>
                <th>标题</th>
                <th>作者</th>
                <th>日期</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($pages as $item):?>
                <tr>
                    <td><input type="checkbox" name="checklist" id="<?php echo 'checkbox'.$item['cid']?>" value="<?php echo $item['cid']?>" /></td>
                    <td><?php echo $item['cid'];?></td>
                    <td>
                        <strong><?php echo anchor( 'about/edit_page/'.$item['cid'], $item['title'], array('title' => '编辑'));?></strong>
                        <div style="padding: 2px 0px 0px;font-size:13px">
                            <span><?php echo anchor('about/edit_page/'.$item['cid'], '编辑', array('title' => '编辑'));?></span>
                            <span><?php echo anchor('#','查看', array('title' => '查看'));?></span>
                        </div>
                    </td>
                    <td><?php echo $item['author'];?></td>
                    <td><?php echo $item['posttime'];?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script type="text/javascript">
        $("#checkAll").click(function(){
                if(this.checked){
                    $("input[name='checklist']").each(function(){
                        this.checked=true;
                    });
                }else{
                    $("input[name='checklist']").each(function(){
                        this.checked=false;
                    });
                }
            }
        );

        $("#delSelected").click(function(){
            var val=new Array();
            $("input[name=checklist]").each(function(){
                    if(this.checked)
                    {
                        val.push(this.value);
                    }
                }
            );
            $.post("<?php echo site_url('article/del_article')?>",{ids:val},function(data){console.log(data);})
        });
    </script>
<?php $this->load->view("footer") ?>