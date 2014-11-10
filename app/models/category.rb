class Category < ActiveRecord::Base
  before_create :generate_slug

  def generate_slug
    self.slug = self.name.parameterize
  end
end
