<?php

/**
 * Admissions : Enrollment
 * @version  1.2
 * @author  Reza Mamun
 */
class AdmissionsController extends AppController {

    /**
     *
     * @var string
     * @access public
     */
    public $name = 'Admissions';

    /**
     * Models used by the Controller
     *
     * @var array
     * @access public
     */
    public $uses = array('Admission', 'Payment', 'PaymentType');
    private $pSalt = '+R*e!2$A-';
    private $pAmount = 5; //DZ14F78546
    public $components = array(
        'Akismet',
        'Email',
        'Recaptcha',
        'ImageUpload',
        'RequestHandler',
        'Acl',
        'Auth',
        'Session',
        'Security',
        'Cookie'
    );

    public function index($id = null) {
        $this->layout = 'default';
        $this->set('scms_tmpl', 'enroll');
        //$tmpl = $this->request->params['action'];
        //pr($this);
        //pr(array_values(array(2=>'ddd',5=>'www','ee'=>3333)));

        $this->set('noSidebar', true); //To be traced in the front layout;
        $this->set('title_for_layout', __('Student Admission'));
        $showSearchForm = TRUE;

        if (($this->request->is('post') && !empty($this->request->data['StudentResult'])) || (!empty($registration) || !empty($termId) || !empty($session))) {
            //=====================
        }
    }

    public function payment($token = null) {
        $this->layout = 'default';
        $this->set('noSidebar', true); //To be traced in the front layout;
        $this->set('title_for_layout', __('Registration Complete'));

        if (!empty($token)) {
            if (($green = $this->Session->read('Admission.success'))
                    && !empty($green['token'])
                    && !empty($green['data']['id'])
                    && !empty($green['data']['ref'])
                    && ($token2 = sha1($green['data']['id'] . $this->pSalt . $green['data']['ref']))
                    && $token == $token2
                    && $token == $green['token']
            ) {
                $this->set('newAdmitter', $this->Admission->read(array('ref', 'name', 'fname', 'mname'), $green['data']['id']));
            } else {
                $this->Session->setFlash('Invalid session!');
            }
        }
    }

    private function is_Ref_Exist_InDb($REF) {
        //Check uniqueness in DB:
        $ref = $this->Admission->field('ref', array(
            'Admission.ref' => $REF,
                //'Admission.session'	=> $session
                ), 'id DESC'
        );
        return $ref;
    }

    private function generateRefNum($session, $level) {
        $schoolCode = 'DZ';
        $sessionPart = substr($session, 2); //last 2 digit;
        $LC = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'L', 'M', 'N', 'O', 'P');
        $REF = $schoolCode . $sessionPart . $LC[$level - 1] . mt_rand(10501, 90905); //????????????????????????????
        return $this->is_Ref_Exist_InDb($REF) ? $this->generateRefNum($session, $level) : $REF;
    }

    public function form($id = null) {
        $this->layout = 'default';
        $this->set('noSidebar', true); //To be traced in the front layout;
        $this->set('title_for_layout', __('Student Admission'));



        /* $newAdmissionId = 13;
          $REF = 'DZ14C30744';
          $token = sha1($newAdmissionId.'+R*e!2$A-'.$REF);//md5(uniqid(rand(), true));
          $this->Session->write('Admission.success', array(
          'token' => $token,
          'data' => array(
          'id'	=> $newAdmissionId,
          'ref'	=> $REF
          )
          ));
          $this->redirect(array('action' => 'payment', $token)); */




        if (!empty($this->request->data) && $this->request->is('post') && !empty($this->request->data['Admission'])) {

            //Prepare DB vars:
            $session = $this->request->data['Admission']['session'] = date('Y') + 1; //????????????????????
            $level = $this->request->data['Admission']['level'];
            $REF = $this->request->data['Admission']['ref'] = $this->generateRefNum($session, $level);
            $this->request->data['Admission']['name'] = strtoupper(trim($this->request->data['Admission']['name']));
            $this->request->data['Admission']['fname'] = strtoupper(trim($this->request->data['Admission']['fname']));
            $this->request->data['Admission']['mname'] = strtoupper(trim($this->request->data['Admission']['mname']));
            $this->request->data['Admission']['created'] = date('Y-m-d');
            $this->request->data['Admission']['status'] = 1;
            //$this->request->data['Admission']['quota'] = '';

            $this->Admission->create($this->request->data);

            $validationErrors = array();
            //$this->Admission->set($this->request->data);
            if ($this->Admission->validates()) {
                // it validated logic:
                //Process File:
                $photo = $this->request->data['Admission']['photo'];
                if ((isset($photo['error']) && $photo['error'] == 0)
                        && (!empty($photo['tmp_name']) && $photo['tmp_name'] != 'none')
                        && (!empty($photo['name']))
                ) {
                    $photographName = $this->ImageUpload->uploadImage($photo, IMAGE_LOCATION5, true);
                    //$this->request->data['Student']['image'] = $photographName['image'];
                    $this->request->data['Admission']['photo'] = $photographName['thumbnail'];
                    if ($this->Admission->save($this->request->data['Admission'], false, array(
                                'name', 'fname', 'mname', 'ref', 'dob', 'mobile', 'level', 'session', 'quota', 'photo', 'created', 'status'
                            ))) {
                        $newAdmissionId = $this->Admission->id;
                        //$this->Session->setFlash('Registration is successful!');

                        $token = sha1($newAdmissionId . $this->pSalt . $REF); //md5(uniqid(rand(), true));
                        $this->Session->write('Admission.success', array(
                            'token' => $token,
                            'data' => array(
                                'id' => $newAdmissionId,
                                'ref' => $REF
                            )
                        ));
                        $smsCnt = $this->sendSMS('admission', array('--'), $this->request->data['Admission']);
                        //$this->Session->delete('Admission.success'); //??????????????????????????????
                        $this->redirect(array('action' => 'payment', $token));
                    }
                } else {
                    $validationErrors = array('image' => 'Image processing error !!');
                }
            } else {
                // didn't validate logic
                $validationErrors = $this->Admission->validationErrors;
            }
            $this->set(compact('validationErrors'));


            /* if( !$this->Admission->save(array('Admission'=>$this->request->data['Admission'])) ){
              $validationErrors = Set::merge( $validationErrors, $this->Admission->validationErrors );
              }

              if( empty( $validationErrors ) ) {
              # TODO: perform any post-save actions
              $this->Session->setFlash('Registration is successful!');
              return $this->redirect('/admissions/index');
              }
              else {
              # Write the complete list of validation errors to the view
              $this->set( compact( 'validationErrors' ) );
              } */
        }

        //http://dev.mysql.com/doc/refman/5.0/en/set.html
        //http://stackoverflow.com/questions/17447666/managing-mysql-set-datatype-in-php
        //http://ftp.nchu.edu.tw/MySQL/tech-resources/articles/mysql-set-datatype.html
    }

    public function admitcard($token = null) {
        $this->layout = 'default';
        $this->set('noSidebar', true); //To be traced in the front layout;
        $this->set('title_for_layout', __('Admission Card Form'));

        //pr($this->request->data);
        //echo $this->is_Ref_Exist_InDb('DZ14J57842');
        //ErrorHandler::missingComponentFile();
        //$resp = $this->chk_bKash('532218675',array('qType'=>'trxid'));
        //echo date('Y-m-d-Hi');
        $resp = $this->chk_bKash(date('Y-m-d-Hi', strtotime('-3 hours')), array('qType' => 'timestamp'));
        pr($resp);






        if (!empty($this->request->data) && $this->request->is('post') && !empty($this->request->data['Admission'])) {
            $session = date('Y') + 1; //????????????????????

            $this->Admission->create($this->request->data);
            $this->Payment->create($this->request->data);

            $validationErrors = array();
            $pStat = $this->Payment->validates(array('fieldList' => array('trxId')));
            $aStat = $this->Admission->validates(array('fieldList' => array('ref')));

            if ($pStat && $aStat) {
                $REF = trim($this->request->data['Admission']['ref']);
                $trxId = trim($this->request->data['Payment']['trxId']);

                $admitter = $this->Admission->find('first', array(
                    'conditions' => array(
                        'Admission.ref' => $REF,
                        'Admission.session' => $session
                    ),
                    'order' => array('Admission.id' => 'desc')
                        ));

                //pr($admitter); //d48e1b381854e4b23049db05e1e07822b584f8c3
                //return;

                if (empty($admitter)) {
                    $validationErrors['pErr'] = 'The reference number doesn\'t exist!!';
                } else {
                    if (!(empty($admitter['Admission']['pay_id']) && $admitter['Admission']['status'] == 'Applied')) {
                        //Already verified;
                        $this->layout = 'scms-admitcard-print';
                        $this->set('title_for_layout', __('Admit Card'));
                        $this->set('admitter', $admitter['Admission']);
                        return;
                    }

                    $response = $this->chk_bKash($trxId, array('qType' => 'trxid'));
                    //pr($response);
                    if ($response && !empty($response->transaction)) {
                        if ($response->transaction->trxStatus == '0000') {
                            if ($response->transaction->reference == $REF) {
                                if ($response->transaction->amount == $this->pAmount) {
                                    //Save To DB with secure transaction:
                                    $dataSource = $this->Admission->getDataSource();
                                    $dataSource->begin();
                                    $pStatus = $this->Payment->save(
                                            array('Payment' => array(
                                            'trxId' => $trxId,
                                            'amount' => $response->transaction->amount,
                                            'sender' => $response->transaction->sender,
                                            'receiver' => $response->transaction->receiver,
                                            'pay_date' => $response->transaction->trxTimestamp,
                                            'pay_type' => 1, //Admission|mFee
                                            'pay_media' => 2, //'Cash'|'bKash'
                                            'created' => date('Y-m-d H:i:s'),
                                            'status' => 2 //Paid;
                                            )), false
                                    );
                                    $newPaymentId = $this->Payment->id;
                                    $aStatus = $this->Admission->save(array('Admission' => array('id' => $admitter['Admission']['id'], 'pay_id' => $newPaymentId, 'status' => 2)), false, array('pay_id', 'status'));

                                    if ($aStatus && $pStatus) {
                                        //All Good:
                                        $dataSource->commit();

                                        $this->layout = 'scms-admitcard-print';
                                        $this->set('title_for_layout', __('Admit Card'));
                                        $this->set('admitter', $admitter['Admission']);
                                        $smsCnt = $this->sendSMS('admission', array('pmnt-verified'), array(
                                            'ref' => $REF,
                                            'trxId' => $trxId,
                                            'name' => $admitter['Admission']['name'],
                                            'level' => $admitter['Admission']['level'],
                                            'mobile' => $admitter['Admission']['mobile']
                                                ));
                                        return;
                                    } else {
                                        $dataSource->rollback();
                                        $validationErrors['pErr'] = 'Verification Error! Please contact with administrator OR try again.';
                                    }
                                } else {
                                    $validationErrors['pErr'] = 'Invalid amount [Tk. ' . $response->transaction->amount . '] is paid! It should be Tk.' . $this->pAmount . ' exactly.';
                                }
                            } else {
                                $validationErrors['pErr'] = 'Oops! The trxId number doesn\'t match with the reference number! Please try with another trxId or reference number.';
                            }
                        } else {
                            $validationErrors['pErr'] = $this->get_bKash_statusMSG($response->transaction->trxStatus);
                        }
                    } else {
                        $validationErrors['pErr'] = 'Network Error !! Please try again.';
                    }
                }
            } else {
                $validationErrors = Set::merge($this->Admission->validationErrors, $this->Payment->validationErrors);
                //pr($validationErrors);
            }
            $this->set(compact('validationErrors'));
        }
    }

    public function admin_index() {
        $this->layout = 'scms-esa';
        $this->set('title_for_layout', __('Admission'));
    }

    /* public function isUploadedFile($params) {
      //http://book.cakephp.org/2.0/en/core-libraries/helpers/form.html
      $val = array_shift($params);
      if( (isset($val['error']) && $val['error'] == 0)
      || (!empty( $val['tmp_name']) && $val['tmp_name'] != 'none')
      ) {
      return is_uploaded_file($val['tmp_name']);
      }
      return false;
      } */
}
