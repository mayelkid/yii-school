<?php

namespace console\controllers;
use yii\console\Controller;
use backend\models\Student;
use backend\models\Family;
use backend\models\Teacher;
use backend\models\Subject;
use backend\models\Classroom;
use backend\models\Course;
use backend\models\School;
use backend\models\Circle;
use backend\models\Leave;
use backend\models\Notice;
use backend\models\Vote;
use backend\models\Introduction;
use backend\models\Choosetasks;
use yii\db\ActiveRecord;
use Yii;		
class StudentController extends Controller
{
	public $server;
	
    //获取所有学生
    public function actionIndex(){
		$this->server = new \swoole_http_server("0.0.0.0", 9502);
		$this->server->on("start", function (\swoole_http_server $server) {
			echo "Swoole http server is started at http://127.0.0.1:9501\n";
		});

		$this->server->on("request", function ($request, $response) {
			$response->header("Content-Type", "application/json");	
			$data = [];
			//$response->end(json_encode($request));	

			switch($request->server['request_uri']){
				case '/student/get':$data = Student::findStudents($request->get);break;
				case '/student/del':$data = Student::delStudent($request->get);break;
				case '/student/add':$data = Student::addStudent($request->get);break;
				case '/student/update':$data = Student::updateStudent($request->get);break;
				case '/family/get':$data = Family::findFamily($request->get);break;
				case '/family/del':$data = Family::delFamily($request->get);break;
				case '/family/add':$data = Family::addFamily($request->get);break;
				case '/family/update':$data = Family::updateFamily($request->get);break;
				case '/teacher/get':$data = Teacher::findTeachers($request->get);break;
				case '/teacher/del':$data = Teacher::delTeacher($request->get);break;
				case '/teacher/add':$data = Teacher::addTeacher($request->get);break;
				case '/teacher/update':$data = Teacher::updateTeacher($request->get);break;
				case '/classroom/get':$data = Classroom::findClassroom($request->get);break;
				case '/classroom/del':$data = Classroom::delClassroom($request->get);break;
				case '/classroom/add':$data = Classroom::addClassroom($request->get);break;
				case '/classroom/update':$data = Classroom::updateClassroom($request->get);break;
				case '/school/get':$data = School::findSchool($request->get);break;
				case '/school/del':$data = School::delSchool($request->get);break;
				case '/school/add':$data = School::addSchool($request->get);break;
				case '/school/update':$data = School::updateSchool($request->get);break;
				case '/subject/get':$data = Subject::findSubjects($request->get);break;
				case '/subject/del':$data = Subject::delSubject($request->get);break;
				case '/subject/add':$data = Subject::addSubject($request->get);break;
				case '/subject/update':$data = Subject::updateSubject($request->get);break;
				case '/course/get':$data = Course::findCourse($request->get);break;
				case '/course/del':$data = Course::delCourse($request->get);break;
				case '/course/add':$data = Course::addCourse($request->get);break;
				case '/course/update':$data = Course::updateCourse($request->get);break;
				case '/circle/get':$data = Circle::findCircle($request->get);break;
				case '/circle/del':$data = Circle::delCircle($request->get);break;
				case '/circle/add':$data = Circle::addCircle($request->get);break;
				case '/circle/update':$data = Circle::updateCircle($request->get);break;
				case '/leave/get':$data = Leave::findLeave($request->get);break;
				case '/leave/del':$data = Leave::delLeave($request->get);break;
				case '/leave/add':$data = Leave::addLeave($request->get);break;
				case '/leave/update':$data = Leave::updateLeave($request->get);break;
				case '/notice/get':$data = Notice::findNotice($request->get);break;
				case '/notice/del':$data = Notice::delNotice($request->get);break;
				case '/notice/add':$data = Notice::addNotice($request->get);break;
				case '/notice/update':$data = Notice::updateNotice($request->get);break;
				case '/vote/get':$data = Vote::findVote($request->get);break;		
				case '/vote/del':$data = Vote::delVote($request->get);break;
				case '/vote/add':$data = Vote::addVote($request->get);break;
				case '/vote/update':$data = Vote::updateVote($request->get);break;	
				case '/introduction/get':$data = Introduction::findIntroduction($request->get);break;		
				case '/introduction/del':$data = Introduction::delIntroduction($request->get);break;
				case '/introduction/add':$data = Introduction::addIntroduction($request->get);break;
				case '/introduction/update':$data = Introduction::updateIntroduction($request->get);break;	
				case '/choosetasks/get':$data = Choosetasks::findChoosetasks($request->get);break;		
				case '/choosetasks/del':$data = Choosetasks::delChoosetasks($request->get);break;
				case '/choosetasks/add':$data = Choosetasks::addChoosetasks($request->get);break;
				case '/choosetasks/update':$data = Choosetasks::updateChoosetasks($request->get);break;	
				default:break;	
			}
			if(isset($data) && $data != ''){
				$arr = [
					'code' => '1',
					'Msg' => '成功',
					'Object'=> $data
				];
			}else{
				$arr = [
					'code' => '0',
					'Msg' => '失败',
					'Object'=> $data
				];
			}
			$response->end(json_encode($arr));	
		});
		return $this->server->start();
	}
	
}			
