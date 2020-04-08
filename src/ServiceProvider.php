<?php
    
    
    namespace Cblink\Feieyun;
    
    
    class ServiceProvider extends \Illuminate\Support\ServiceProvider
    {
        protected $defer = true;
    
        public function register()
        {
            $this->app->singleton(HttpClient::class, function(){
                return new HttpClient(config('services.feieyun'));
            });
        
            $this->app->alias(HttpClient::class, 'feieyun');
        }
    
        public function provides()
        {
            return [HttpClient::class, 'feieyun'];
        }
    }