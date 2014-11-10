require "rails_helper"

RSpec.describe Category, :type => :model do
  it "creates a new category" do
    @category = Category.new(name: "test")
    expect(@category).to be_valid
  end

  it "create a new category with slug" do
    @category = Category.create(name: "test name")
    expect(@category.slug).to eq "test-name"
    @category1 = Category.create(name: "Cap name")
    expect(@category1.slug).to eq "cap-name"
  end
end