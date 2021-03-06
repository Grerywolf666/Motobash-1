/**
 *  Copyright 2009-2014 MongoDB, Inc.
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *  http://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 */
#ifndef MONGO_COLLECTION_H
#define MONGO_COLLECTION_H

#define MAX_INDEX_NAME_LEN 127

zend_object_value php_mongo_collection_new(zend_class_entry* TSRMLS_DC);
void php_mongo_collection_construct(zval *this, zval *parent, char *name_str, int name_len TSRMLS_DC);
int php_mongo_collection_find(mongo_cursor *cursor, mongo_collection *c, zval *query, zval *fields TSRMLS_DC);
void mongo_apply_implicit_write_options(php_mongo_write_options *write_options, mongo_server_options *server_options, zval *collection TSRMLS_DC);
mongo_connection* php_mongo_collection_get_server(mongoclient *link, int connection_flags TSRMLS_DC);

PHP_METHOD(MongoCollection, __construct);
PHP_METHOD(MongoCollection, __toString);
PHP_METHOD(MongoCollection, __get);
PHP_METHOD(MongoCollection, getName);
PHP_METHOD(MongoCollection, getSlaveOkay);
PHP_METHOD(MongoCollection, setSlaveOkay);
PHP_METHOD(MongoCollection, getReadPreference);
PHP_METHOD(MongoCollection, setReadPreference);
PHP_METHOD(MongoCollection, drop);
PHP_METHOD(MongoCollection, validate);
PHP_METHOD(MongoCollection, insert);
PHP_METHOD(MongoCollection, batchInsert);
PHP_METHOD(MongoCollection, update);
PHP_METHOD(MongoCollection, remove);
PHP_METHOD(MongoCollection, find);
PHP_METHOD(MongoCollection, findOne);
PHP_METHOD(MongoCollection, createIndex);
PHP_METHOD(MongoCollection, ensureIndex);
PHP_METHOD(MongoCollection, deleteIndex);
PHP_METHOD(MongoCollection, getIndexInfo);
PHP_METHOD(MongoCollection, count);
PHP_METHOD(MongoCollection, save);
PHP_METHOD(MongoCollection, createDBRef);
PHP_METHOD(MongoCollection, getDBRef);
PHP_METHOD(MongoCollection, toIndexString);
PHP_METHOD(MongoCollection, group);
PHP_METHOD(MongoCollection, parallelCollectionScan);

#endif /* MONGO_COLLECTION_H */

/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 * vim600: fdm=marker
 * vim: noet sw=4 ts=4
 */
