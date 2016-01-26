<?php
namespace App\Support;

class Tree
{
    public $items = array();

    public $icon = array('│','├','└');

    public $nbsp = "&nbsp;";


    public $result = '';

    public function __construct(array $items = [])
    {
        $this->items = $items;
        $this->result = '';
    }

    /**
     * 得到父级数组
     * @param int
     * @return array
     */
    public function get_parent($myid){
        $newarr = array();
        if(!isset($this->arr[$myid])) return false;
        $pid = $this->arr[$myid]['parentid'];
        $pid = $this->arr[$pid]['parentid'];
        if(is_array($this->arr)){
            foreach($this->arr as $id => $a){
                if($a['parentid'] == $pid) $newarr[$id] = $a;
            }
        }
        return $newarr;
    }

    public function getChild($cid)
    {
        $children = [];

        if (is_array($this->items)) {
            foreach ($this->items as $id => $item) {
                if ($item['parentid'] == $cid) {
                    $children[$id] = $item;
                }
            }
        }

        return !empty($children) ? $children : false;
    }

    /**
     * 得到当前位置数组
     * @param int
     * @return array
     */
    public function get_pos($myid,&$newarr){
        $a = array();
        if(!isset($this->arr[$myid])) return false;
        $newarr[] = $this->arr[$myid];
        $pid = $this->arr[$myid]['parentid'];
        if(isset($this->arr[$pid])){
            $this->get_pos($pid,$newarr);
        }
        if(is_array($newarr)){
            krsort($newarr);
            foreach($newarr as $v){
                $a[$v['id']] = $v;
            }
        }
        return $a;
    }

    public function getTree($cid, $str, $sid = 0, $adds = '', $str_group = '')
    {
        $number=1;

        $children = $this->getChild($cid);

        if(is_array($children)){
            $total = count($children);

            foreach($children as $id => $item){
                $j = $k = '';
                if($number == $total) {
                    $j .= $this->icon[2];
                } else {
                    $j .= $this->icon[1];
                    $k = $adds ? $this->icon[0] : '';
                }

                $spacer = $adds ? $adds.$j : '';
                $selected = $id == $sid ? 'selected' : '';

                @extract($item);
                $parentid == 0 && $str_group ? eval("\$nstr = \"$str_group\";") : eval("\$nstr = \"$str\";");

                $this->result .= $nstr;
                $nbsp = $this->nbsp;

                $this->getTree($id, $str, $sid, $adds.$k.$nbsp, $str_group);

                $number++;
            }
        }

        return $this->result;
    }
    /**
     * 同上一方法类似,但允许多选
     */
    public function get_tree_multi($myid, $str, $sid = 0, $adds = ''){
        $number=1;
        $child = $this->get_child($myid);
        if(is_array($child)){
            $total = count($child);
            foreach($child as $id=>$a){
                $j=$k='';
                if($number==$total){
                    $j .= $this->icon[2];
                }else{
                    $j .= $this->icon[1];
                    $k = $adds ? $this->icon[0] : '';
                }
                $spacer = $adds ? $adds.$j : '';

                $selected = $this->have($sid,$id) ? 'selected' : '';
                @extract($a);
                eval("\$nstr = \"$str\";");
                $this->ret .= $nstr;
                $this->get_tree_multi($id, $str, $sid, $adds.$k.'&nbsp;');
                $number++;
            }
        }
        return $this->ret;
    }
    /**
     * @param integer $myid 要查询的ID
     * @param string $str   第一种HTML代码方式
     * @param string $str2  第二种HTML代码方式
     * @param integer $sid  默认选中
     * @param integer $adds 前缀
     */
    public function get_tree_category($myid, $str, $str2, $sid = 0, $adds = ''){
        $number=1;
        $child = $this->get_child($myid);
        if(is_array($child)){
            $total = count($child);
            foreach($child as $id=>$a){
                $j=$k='';
                if($number==$total){
                    $j .= $this->icon[2];
                }else{
                    $j .= $this->icon[1];
                    $k = $adds ? $this->icon[0] : '';
                }
                $spacer = $adds ? $adds.$j : '';

                $selected = $this->have($sid,$id) ? 'selected' : '';
                @extract($a);
                if (empty($html_disabled)) {
                    eval("\$nstr = \"$str\";");
                } else {
                    eval("\$nstr = \"$str2\";");
                }
                $this->ret .= $nstr;
                $this->get_tree_category($id, $str, $str2, $sid, $adds.$k.'&nbsp;');
                $number++;
            }
        }
        return $this->ret;
    }

    /**
     * 同上一类方法，jquery treeview 风格，可伸缩样式（需要treeview插件支持）
     * @param $myid 表示获得这个ID下的所有子级
     * @param $effected_id 需要生成treeview目录数的id
     * @param $str 末级样式
     * @param $str2 目录级别样式
     * @param $showlevel 直接显示层级数，其余为异步显示，0为全部限制
     * @param $style 目录样式 默认 filetree 可增加其他样式如'filetree treeview-famfamfam'
     * @param $currentlevel 计算当前层级，递归使用 适用改函数时不需要用该参数
     * @param $recursion 递归使用 外部调用时为FALSE
     */
    function get_treeview($myid,$effected_id='example',$str="<span class='file'>\$name</span>", $str2="<span class='folder'>\$name</span>" ,$showlevel = 0 ,$style='filetree ' , $currentlevel = 1,$recursion=FALSE) {
        $child = $this->get_child($myid);
        if(!defined('EFFECTED_INIT')){
            $effected = ' id="'.$effected_id.'"';
            define('EFFECTED_INIT', 1);
        } else {
            $effected = '';
        }
        $placeholder =  '<ul><li><span class="placeholder"></span></li></ul>';
        if(!$recursion) $this->str .='<ul'.$effected.'  class="'.$style.'">';
        foreach($child as $id=>$a) {

            @extract($a);
            if($showlevel > 0 && $showlevel == $currentlevel && $this->get_child($id)) $folder = 'hasChildren'; //如设置显示层级模式@2011.07.01
            $floder_status = isset($folder) ? ' class="'.$folder.'"' : '';
            $this->str .= $recursion ? '<ul><li'.$floder_status.' id=\''.$id.'\'>' : '<li'.$floder_status.' id=\''.$id.'\'>';
            $recursion = FALSE;
            if($this->get_child($id)){
                eval("\$nstr = \"$str2\";");
                $this->str .= $nstr;
                if($showlevel == 0 || ($showlevel > 0 && $showlevel > $currentlevel)) {
                    $this->get_treeview($id, $effected_id, $str, $str2, $showlevel, $style, $currentlevel+1, TRUE);
                } elseif($showlevel > 0 && $showlevel == $currentlevel) {
                    $this->str .= $placeholder;
                }
            } else {
                eval("\$nstr = \"$str\";");
                $this->str .= $nstr;
            }
            $this->str .=$recursion ? '</li></ul>': '</li>';
        }
        if(!$recursion)  $this->str .='</ul>';
        return $this->str;
    }

    /**
     * 获取子栏目json
     * Enter description here ...
     * @param unknown_type $myid
     */
    public function creat_sub_json($myid, $str='') {
        $sub_cats = $this->get_child($myid);
        $n = 0;
        if(is_array($sub_cats)) foreach($sub_cats as $c) {
                $data[$n]['id'] = iconv(CHARSET,'utf-8',$c['catid']);
                if($this->get_child($c['catid'])) {
                    $data[$n]['liclass'] = 'hasChildren';
                    $data[$n]['children'] = array(array('text'=>'&nbsp;','classes'=>'placeholder'));
                    $data[$n]['classes'] = 'folder';
                    $data[$n]['text'] = iconv(CHARSET,'utf-8',$c['catname']);
                } else {
                    if($str) {
                        @extract(array_iconv($c,CHARSET,'utf-8'));
                        eval("\$data[$n]['text'] = \"$str\";");
                    } else {
                        $data[$n]['text'] = iconv(CHARSET,'utf-8',$c['catname']);
                    }
                }
                $n++;
            }
        return json_encode($data);
    }
    private function have($list,$item){
        return(strpos(',,'.$list.',',','.$item.','));
    }
}
