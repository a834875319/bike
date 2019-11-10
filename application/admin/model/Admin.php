<?php


namespace app\admin\model;


use think\Model;

class Admin extends Model
{
    /*protected $pk = 'id';
    protected $table = 'bk_admin';*/
    /**
     * ->join("app_tool_ext_grant AS g ON g.tool_id = t.id", 'LEFT')

     * $userRole = M("user_role");
    $table = $userRole //->alias('ur')
    ->join('smatrix_user ON smatrix_user.id = smatrix_user_role.userid')
    ->join('smatrix_role ON smatrix_role.id = smatrix_user_role.roleid')
    ->field('smatrix_user_role.*')->select();
    dump($table);
     * @param $data
     * @return bool
     */
    public function addAdmin($data)
    {
        if (empty($data) || !is_array($data)) {
            return false;
        } else {
            foreach ($data as $key => $value) {
                echo "Key=" . $key . ", Value=" . $value;
                echo "<br>";
                $trimStr = trim($value);
                if (empty($trimStr)) return false;
                $data[$key] = $trimStr;
            }
            $res = $this->save($data);
            if ($res && $res > 0)
                return true;
            else
                return false;
        }
    }
    public function selectPage($params=[]){
        /*if (empty($params)) {
            throw new \Exception(Error::ERROR_INVALID_PARAMETER_MSG . ',[checkParamsExists] the array of params is empty', Error::ERROR_INVALID_PARAMETER_CODE);
        }
        $params = is_array($params) ? $params : [$params];
        if ($fields) {
            $fields = array_flip($fields);
            $params = array_merge($params, $fields);
        }
        foreach ($mod as $mod_key => $mod_value) {
            if (!array_key_exists($mod_value, $params)) {
                throw new \Exception(Error::ERROR_INVALID_PARAMETER_MSG . ',[checkParamsExists]' . json_encode($params) . ' do not have key field(' . $mod_value . ')', Error::ERROR_INVALID_PARAMETER_CODE);
            }
        }*/
        /*$res = array();
        if (array_key_exists('page', $params) && array_key_exists('pageSize', $params)) {
            $res = $this->page($params['page'],$params['pageSize'])->select();
        }else{
            $res = $this->select();
        }*/
        /*if(!empty($pageNo) && !empty($pageSize) ){
            $res = $this->page($pageNo,$pageSize)->select();
        }else{
            $res = $this->select();
        }*/
//        $page = $params['page'];
//        dump($page);
        array_splice($params,array_search('page' , $params),1);
//        die();
        $res = $this->paginate(3);
        return $res;
    }


    public function findAdminById($id){
        return $this->where('id',$id)->select();
    }
}

