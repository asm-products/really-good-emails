class Category < ActiveRecord::Base
  before_save :generate_url

  def generate_url
    self.slug = self.name.parameterize
  end
end
