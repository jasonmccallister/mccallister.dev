ENV ?= prod

serve:
	vendor/bin/yii serve --docroot=./web
deploy:
	serverless deploy --verbose --stage=${ENV}
