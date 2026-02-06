
    //$districts = Cache::remember($cacheKey, now()->addMinutes(30), function () {

         District::select('id', 'name', 'lot_id', 'target')
            ->withCount([

                // ======================= STAGE 1 =======================

                'getsurveydata as ceo_approved_14_days_ago' => function ($q) {
                    $q->whereDoesntHave('relation_with_stage')
                      ->whereHas('getformstatusold', function ($q) {
                          $q->where('user_status', '40')
                            ->where('form_status', 'A')
                            ->whereDate('updated_at', '<=', Carbon::now()->subDays(14));
                      })
                      ->whereHas('getfirstbatch', function ($q) {
                          $q->where('trench_no', '1')
                            ->whereHas('getbatch', function ($q) {
                                $q->where('trench_no', '1')
                                  ->whereNotNull('cheque_no')
                                  ->where('cheque_no', '!=', '');
                            });
                      });
                },

                'getsurveydata as first_tranche_disbursed_45_days_ago' => function ($q) {
                    $q->whereDoesntHave('relation_with_stage')
                      ->whereHas('getformstatusold', fn ($q) =>
                          $q->where('user_status', '40')->where('form_status', 'A')
                      )
                      ->whereHas('getfirstbatch', function ($q) {
                          $q->where('trench_no', '1')
                            ->whereDate('created_at', '<=', Carbon::now()->subDays(45))
                            ->whereHas('getbatch', function ($q) {
                                $q->where('trench_no', '1')
                                  ->whereNotNull('cheque_no')
                                  ->where('cheque_no', '!=', '');
                            });
                      });
                },

                'getsurveydata as ip_not_verified_more_than_5_days_stage1' => function ($q) {
                    $q->whereHas('relation_with_stage', function ($q) {
                        $q->where('stage', 'Stage 1')
                          ->whereHas('getdepartmentstatus', function ($q) {
                              $q->where('role_id', '34')
                                ->where('status', 'P')
                                ->whereDate('created_at', '<=', Carbon::now()->subDays(5));
                          });
                    })
                    ->whereHas('getformstatusold', fn ($q) =>
                        $q->where('user_status', '40')->where('form_status', 'A')
                    )
                    ->whereHas('getfirstbatch', fn ($q) =>
                        $q->where('trench_no', '1')
                          ->whereHas('getbatch', fn ($q) =>
                              $q->where('trench_no', '1')
                                ->whereNotNull('cheque_no')
                                ->where('cheque_no', '!=', '')
                          )
                    );
                },

                // ======================= STAGE 2 =======================

                'getsurveydata as second_tranche_disbursed_30_days_ago_stage2' => function ($q) {
                    $q->whereDoesntHave('relation_with_stage', fn ($q) => $q->where('stage', 'Stage 2'))
                      ->whereHas('getformstatusold', fn ($q) =>
                          $q->where('user_status', '40')->where('form_status', 'A')
                      )
                      ->whereHas('getfirstbatch', function ($q) {
                          $q->where('trench_no', '2')
                            ->whereDate('created_at', '<=', Carbon::now()->subDays(30))
                            ->whereHas('getbatch', function ($q) {
                                $q->where('trench_no', '2')
                                  ->whereNotNull('cheque_no')
                                  ->where('cheque_no', '!=', '');
                            });
                      });
                },

                'getsurveydata as ceo_approved_stage2' => function ($q) {
                    $q->whereHas('relation_with_stage', fn ($q) => $q->where('stage', 'Stage 2'))
                      ->whereHas('getformstatusold', fn ($q) =>
                          $q->where('user_status', '40')->where('form_status', 'A')
                      )
                      ->whereHas('getfirstbatch', fn ($q) =>
                          $q->where('trench_no', '2')
                            ->whereHas('getbatch', fn ($q) =>
                                $q->where      ('trench_no', '2')
                                  ->whereNotNull('cheque_no')
                                  ->where('cheque_no', '!=', '')
                            )
                      );
                },

                // ======================= STAGE 3 =======================

                'getsurveydata as third_tranche_disbursed_20_days_ago' => function ($q) {
                    $q->whereDoesntHave('relation_with_stage', fn ($q) => $q->where('stage', 'Stage 3'))
                      ->whereHas('getformstatusold', fn ($q) =>
                          $q->where('user_status', '40')->where('form_status', 'A')
                      )
                      ->whereHas('getfirstbatch', function ($q) {
                          $q->where('trench_no', '3')
                            ->whereDate('created_at', '<=', Carbon::now()->subDays(20))
                            ->whereHas('getbatch', function ($q) {
                                $q->where('trench_no', '3')
                                  ->whereNotNull('cheque_no')
                                  ->where('cheque_no', '!=', '');
                            });
                      });
                },

                'getsurveydata as ceo_approved_stage3' => function ($q) {
                    $q->whereHas('relation_with_stage', fn ($q) => $q->where('stage', 'Stage 3'))
                      ->whereHas('getformstatusold', fn ($q) =>
                          $q->where('user_status', '40')->where('form_status', 'A')
                      )
                      ->whereHas('getfirstbatch', fn ($q) =>
                          $q->where('trench_no', '3')
                            ->whereHas('getbatch', fn ($q) =>
                                $q->where('trench_no', '3')
                                  ->whereNotNull('cheque_no')
                                  ->where('cheque_no', '!=', '')
                            )
                      );
                },

                // ======================= STAGE 4 =======================

                'getsurveydata as completed_stage4' => function ($q) {
                    $q->whereHas('relation_with_stage', function ($q) {
                        $q->where('stage', 'Stage 4')
                          ->whereHas('getdepartmentstatus', function ($q) {
                              $q->where('role_id', '48')
                                ->where('status', 'P')
                                ->whereDate('created_at', '<=', Carbon::now()->subDays(3));
                          });
                    })
                    ->whereHas('getformstatusold', fn ($q) =>
                        $q->where('user_status', '40')->where('form_status', 'A')
                    )
                    ->whereHas('getfirstbatch', fn ($q) =>
                        $q->where('trench_no', '4')
                          ->whereHas('getbatch', fn ($q) =>
                              $q->where('trench_no', '4')
                                ->whereNotNull('cheque_no')
                                ->where('cheque_no', '!=', '')
                          )
                    );
                },

            ])
            //->where('id', $this->id)
            ->orderBy('lot_id')
            ->get();
        
        return $totals = [
            'ceo_approved_14_days_ago'            => $districts->sum('ceo_approved_14_days_ago'),
            'ip_not_verified_more_than_5_days_stage1'   => $districts->sum('ip_not_verified_more_than_5_days_stage1'),
            'second_tranche_disbursed_30_days_ago_stage2' => $districts->sum('second_tranche_disbursed_30_days_ago_stage2'),
            'ceo_approved_stage2'   => $districts->sum('ceo_approved_stage2'),
            'third_tranche_disbursed_20_days_ago'   => $districts->sum('third_tranche_disbursed_20_days_ago'),
            'ceo_approved_stage3'   => $districts->sum('ceo_approved_stage3'),
            'completed_stage4'   => $districts->sum('completed_stage4'),
        ];
        
            
    });