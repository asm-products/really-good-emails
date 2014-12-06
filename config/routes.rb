Rails.application.routes.draw do
  resources :categories

  get '/styleguide' => 'pages#styleguide'
end
