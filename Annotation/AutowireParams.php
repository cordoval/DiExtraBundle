<?php

/*
 * Copyright 2011 Johannes M. Schmitt <schmittjoh@gmail.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace JMS\DiExtraBundle\Annotation;

use JMS\DiExtraBundle\Exception\InvalidTypeException;

final class AutowireParams
{
    public $params = array();

    public function __construct(array $values)
    {
        if (isset($values['params'])) {
            $values['value'] = $values['params'];
        }

        if (isset($values['value'])) {
            if (!is_array($values['value'])) {
                throw new InvalidTypeException('AutowireParams', 'value', 'array', $values['value']);
            }

            foreach ($values['value'] as $k => $v) {
                if (!$v instanceof Autowire) {
                    throw new InvalidTypeException('AutowireParams', sprintf('value[%s]', $k), '@Autowire', $v);
                }

                $this->params[$k] = $v;
            }
        }
    }
}